<?php

use App\Province;
use App\Commune;

function state($state) {
	if ($state==0) {
		return '<span class="badge badge-danger">Inactivo</span>';
	} elseif ($state==1) {
		return '<span class="badge badge-success">Activo</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function stateNew($state) {
	if ($state==1) {
		return '<span class="badge badge-primary">Publicado</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-info">Borrador</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function stateReport($state) {
	if ($state==1) {
		return '<span class="badge badge-primary">Cerrado</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-warning">Abierto</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function stateDiary($state) {
	if ($state==0) {
		return '<span class="badge badge-danger">Cancelado</span>';
	} elseif ($state==1) {
		return '<span class="badge badge-success">Activo</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function typeUser($type, $badge=1) {
	if ($badge==1) {
		if ($type==1) {
			return '<span class="badge badge-primary">Super Admin</span>';
		} else {
			return '<span class="badge badge-dark">Desconocido</span>';
		}
	} elseif ($badge==0) {
		if ($type==1) {
			return 'Super Admin';
		} else {
			return 'Desconocido';
		}
	}
}

function active($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'active';
				}
			}
		}
		return '';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'active' : '';
		}
	}
}

function menu_expanded($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'true';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'true';
				}
			}
		}
		return 'false';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'true' : 'false';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'true' : 'false';
		}
	}
}

function submenu($path, $action=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($action)) {
				if (request()->is($url)) {
					return 'class=active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'show';
				}
			}
		}
		return '';
	} else {
		if (is_null($action)) {
			return request()->is($path) ? 'class=active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'show' : '';
		}
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->slug==$array->slug) {
					$select="selected";
					break;
				} elseif ($selected==$array->slug) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function store_files($file, $file_name, $route) {
	$image=$file_name.".".$file->getClientOriginalExtension();
	if (file_exists(public_path().$route.$image)) {
		unlink(public_path().$route.$image);
	}
	$file->move(public_path().$route, $image);
	return $image;
}

function image_exist($file_route, $image, $user_image=false, $large=true) {
	if (file_exists(public_path().$file_route.$image)) {
		$img=asset($file_route.$image);
	} else {
		if ($user_image) {
			$img=asset("/admins/img/template/usuario.png");
		} else {
			if ($large) {
				$img=asset("/admins/img/template/imagen.jpg");
			} else {
				$img=asset("/admins/img/template/image.jpg");
			}
		}
	}

	return $img;
}

function selectReport($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->exam->slug==$array->slug) {
					$select="selected";
					break;
				}  else {
					$select="";
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->subcategory->category->name.' | '.$array->subcategory->name.' | '.$array->type->name.'</option>';
	}
	return $selects;
}

function selectProvince($selected, $region) {
	$provinces=Province::where('region_id', $region)->orderBy('name', 'ASC')->get();
	$selects="";
	foreach ($provinces as $province) {
		if ($selected==$province->id) {
			$select="selected";
		} else {
			$select="";
		}
		$selects.='<option value="'.$province->id.'" '.$select.'>'.$province->name.'</option>';
	}
	return $selects;
}

function selectCommune($selected, $province) {
	$communes=Commune::where('province_id', $province)->orderBy('name', 'ASC')->get();
	$selects="";
	foreach ($communes as $commune) {
		if ($selected==$commune->id) {
			$select="selected";
		} else {
			$select="";
		}
		$selects.='<option value="'.$commune->id.'" '.$select.'>'.$commune->name.'</option>';
	}
	return $selects;
}

function selectServices($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if ($selected->service_id==$array->id) {
					$select="selected";
					break;
				} else {
					$select="";
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function age($date) {
	list($year, $month, $day)=explode("-", $date);
	$year_diference=date("Y")-$year;
	$month_diference=date("m")-$month;
	$day_diference=date("d")-$day;
	if ($day_diference < 0 || $month_diference < 0) {
		$year_diference--;
	}
	return $year_diference." Años";
}

function day($day) {
	if ($day==0) {
		$day="Domingo";
	} elseif ($day==1) {
		$day="Lunes";
	} elseif ($day==2) {
		$day="Martes";
	} elseif ($day==3) {
		$day="Miércoles";
	} elseif ($day==4) {
		$day="Jueves";
	} elseif ($day==5) {
		$day="Viernes";
	} elseif ($day==6) {
		$day="Sábado";
	}
	return $day;
}

function urlDoctorService($services, $type) {
	$select=false;
	if (count($services)>0) {
		foreach ($services as $service) {
			if ($service->service->slug=="consulta-virtual") {
				$select=true;
				break;
			}
		}
	}

	if ($type==1) {
		if ($select) {
			return "";
		} else {
			return "d-none";
		}
	} else {
		if ($select) {
			return "required";
		} else {
			return "";
		}
	}
}