<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MenuModel extends CI_Model{
 
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
	}

	public function akses_menu($id_level){
		// echo 'tes'.$id_level;exit();
		$sql = "SELECT a.id_menu,a.id_level,b.title_menu,b.icon_menu,b.link,b.parentID,b.id_status
				from _level_menu a
				LEFT JOIN _menu b on a.id_menu = b.id_menu
				WHERE a.id_level = ".$id_level." and b.parentID = 0 and b.id_status = 1
				ORDER BY a.id_menu ASC";
		// 
		$menu = $this->db->query($sql)->result();

		$mnu = "";
		foreach ($menu as $menu) {
			$mnu.='
				<div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="'.$menu->icon_menu.'"></i><span>'.$menu->title_menu.'</span></a>';
                    $sub_sql = "SELECT a.id_menu,a.id_level,b.title_menu,b.icon_menu,b.link,b.parentID,b.id_status
								from _level_menu a
								LEFT JOIN _menu b on a.id_menu = b.id_menu
								WHERE b.parentID = ".$menu->id_menu." 
								and a.id_level= ".$id_level."
								and b.id_status = 1
								ORDER BY b.id_menu ASC";
					// echo $sub_sql;exit();
					$sub_menu = $this->db->query($sub_sql)->result();
					foreach ($sub_menu as $sub_menu) {
						$mnu.='
							<div class="submenu-content">
                                <a href="'.base_url($sub_menu->link).'" class="'.$sub_menu->icon_menu.'">'.$sub_menu->title_menu.'</a>
                            </div>
						';
					}
            $mnu.='
                </div>
			';
		}
		// echo $mnu;exit();
		return $mnu;
	}

	
	
  	public function akses_menu2($link,$id_level) {
		$q  = "SELECT a.id_level,a.id_menu,b.title_menu,b.link,a.`create`,a.`update`,a.`delete`
				FROM _level_menu a
				LEFT JOIN _menu b on a.id_menu = b.id_menu
				WHERE b.link = '".$link."' AND a.id_level = ".$id_level." ";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
	    return $rs;
  	}

}