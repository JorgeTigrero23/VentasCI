<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Rol;
use App\Models\Uimage;
use App\Models\User;
use App\Models\ClientType;
use App\Repositories\UserRepository;
use Facades\App\Menu;
use App\Models\Option;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $rols = Rol::all();
        $rolsUser= [];
        $create =1;
        return view('users.create',compact('rols','rolsUser','create'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $file = $request->file('image');

        if($request->hasFile('image'))
        {
            $input['image'] = uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('profile'),  $input['image']);

            $user = $this->userRepository->create($input);
        }else{
            $input['image'] = "avatar_none.png";
        }

        if($user && $request->rols){
            $user->rols()->sync($request->rols);
        }

        Flash::success('User guardado exitosamente.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect(route('users.index'));
        }

        $rols = Rol::all();
        $rolsUser = array_pluck($user->rols->toArray(),"id");

        return view('users.edit',compact('user','rolsUser','rols'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect(route('users.index'));
        }

//        dd($user->toArray(),$request->toArray());
//
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');

            $user->image = uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('profile'),  $user->image);
        }
        
        if(!is_null($request->password) && !is_null($request->password_confirmation)){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $rols = $request->rols ? $request->rols : [];
        $user->rols()->sync($rols);


        Flash::success('User actualizado exitosamente.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User eliminado exitosamente.');

        return redirect(route('users.index'));
    }

    /**
     * Muestra al vista para poder asignar opciones del menu a un usuario
     *
     * @param $id id del usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu(User $user){

        $options= Option::all();
        $menu= Menu::renderUser($options,0,$user);

        return view("users.menu",compact('user','menu'));
    }

    /**
     * Guarda lsa opciones de menu que se decidieron asignar al usuario
     *
     * @param Request $request
     * @param $id usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menuStore(User $user){
        
        $options = is_null(request()->options) ? array() : request()->options;

        $user->options()->sync($options);

        Flash::success('Menu del usuario actualizado!')->important();

        return redirect("admin/user/{$user->id}/menu");
    }

    public function saveImage(User $user,Request $request)
    {
        $file = $request->file('imagen');

        $imagen = New Uimage([
            'user_id' => $user->id,
            'data' => fileToBinary($file),
//            'data' => null,
            'name' => $file->getClientOriginalName(),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'extension' => $file->extension()
        ]);

        $user->uimages()->delete();
        $user->uimages()->save($imagen);
    }

    /**
     * Muestra form para editar el perfil de usuario
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editProfile($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect(route('users.index'));
        }

        return view('users.edit_profile',compact('user'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function updateProfile(User $user, Request $request)
    {

        if (empty($user)) {
            Flash::error('User no encontrado');

            return redirect()->back();
        }

        if(!is_null($request->password) && !is_null($request->password_confirmation)){

            if(isset($request->password)){
                $rules = [
                    'password' => 'min:6|confirmed',
                ];
        
                $messages = [
                    'password' => 'min:6|confirmed',
                ];
        
                $this->validate($request,$rules, $messages);
            }

            $user->password = bcrypt($request->password);
        }

        if($request->has('image'))
        {
            $rules = [
                'image'    => 'mimes:jpeg,png,bmp',
            ];
    
            $messages = [
                'image.mimes' => 'La imagen debe ser de tipo jpeg, png y bmp.',
            ];
    
            $this->validate($request,$rules, $messages);
    
            $file = $request->file('image');
    
            $user->image = uniqid().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('profile'),  $user->image);
        }

        if($user->isClean())
        {
            Flash::error('Debe especificar al menos un cambio.');

            return redirect()->back()->with('user',$user);
        }

        $user->save();

        Flash::success('Perfil actualizado exitosamente.');

        return redirect()->back()->with('user',$user);
    }
}
