<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 9/03/2017
 * Time: 4:22 PM
 */

namespace App;


class Menu{

    /**
     * Comprueba si una opcion tien sub opciones
     * @param $opciones
     * @param $id
     * @return bool
     */
    public function has_children($options,$id) {
        foreach ($options as $option) {
            if ($option->father == $id)
                return true;
        }
        return false;
    }

    /**
     * Genera el menu que se muestra en la seccion sidebar
     * @param $opciones
     * @param int $parent
     * @return string
     */
    public function render($options,$parent=0){

        $result = $parent==0 ? "<ul class=\"sidebar-menu\"><li class=\"header\"></li>" : "<ul class=\"treeview-menu\">";
        foreach ($options as $option)
        {
            if ($option->father == $parent){
                $path= $option->path."";
                $path = url($path);
                $has_children= ($this->has_children($options,$option->id) || $option->father=="") ? true : false;

                $result.= $has_children ? "<li class='treeview'>" : "<li>";
                $result.= "<a href=\"{$path}\">";
                $result.= "<i class=\"fa {$option->icon_l}\"></i>";
                $result.= $has_children ? "<span>{$option->name}</span>" : $option->name;
                $result.= "<i class=\"fa {$option->icon_r} pull-right\"></i>";
                $result.= "</a>";

                if ($this->has_children($options,$option->id))
                    $result.= $this->render($options,$option->id);
                $result.= "</li>";
            }
        }
        $result.= "</ul>";

        return $result;
    }


    /**
     * Genera el menu con opciones para crear, editar y eliminar las opciones
     * @param $opciones
     * @param int $parent
     * @return string
     */
    public function renderAdmin($options,$parent=0){

        $result = "<ul class=\"sortable list-group\">";

        foreach ($options as $option) {
            if ($option->father == $parent){

                $actionEdit = action('Administration\OptionMenuController@edit',$option->id);
                $actionDelet = action('Administration\OptionMenuController@destroy',["id" => $option->id]);
                $rutaNew= url("/admin/option/create/{$option->id}");

                $result.= "<li class='list-group-item' id='{$option->id}' ><span class='glyphicon glyphicon-resize-vertical'></span> <b>{$option->name}</b>";
                $result.= " <a href=\"{$rutaNew}\" class='text-green text-sm' data-toggle=\"tooltip\" title=\"Nueva opcion\"><span class=\"glyphicon glyphicon-plus\"></span></a>";
                $result.= " <a href=\"{$actionEdit}\" data-toggle=\"tooltip\" title=\"Editar\"><span class='glyphicon glyphicon-edit'></span></a>";
                $result.= " <a data-toggle='modal' href='#modal-delete' data-action=\"{$actionDelet}\" class='text-danger btn-delete' ><span class=\"glyphicon glyphicon-remove\"  data-toggle=\"tooltip\" title=\"Eliminar\"></span></a>";

                if ($this->has_children($options,$option->id))
                    $result.=  $this->renderAdmin($options,$option->id);
                $result.= "</li>";
            }
        }
        $result.= "</ul>";


        return $result;
    }

    /**
     * Genera el menu con checkbos en cada opción para asignar o quitar opciones al usuario
     * @param $opciones
     * @param int $parent
     * @param $usuario
     * @return string
     */
    public function renderUser($options,$parent=0,$user){

        $optionUser =  array_pluck($user->options->toArray(),'id');

        $result = "<ul>";

        foreach ($options as $option) {
            if ($option->father == $parent){

                $checked = in_array($option->id,$optionUser) ? 'checked' : '';

                $result.= "<li>";
                $result.= "<div class=\"checkbox\">
                                	<label>
                                		<input type=\"checkbox\" value=\"{$option->id}\" name=\"options[]\" { $checked }>
                                		{$option->name}
                                	</label>
                                </div>";

                if ($this->has_children($options,$option->id))
                    $result.= $this->renderUser($options,$option->id,$user);
                $result.= "</li>";
            }
        }
        $result.= "</ul>";


        return $result;
    }

}