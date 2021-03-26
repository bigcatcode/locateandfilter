<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Tools 
 * 
 * @package Locate_And_Filter
 * @subpackage Locate_And_Filter/admin
 * @author AMonin <monothemes@gmail.com>
 */
class Locate_And_Filter_Tools {
	public function __construct($plugin_name, $version) {}
	

	/**
	 * Helper function : curl get
	 * @param  [string] $url [URL]
	 * @return [mixed]  file data
	 */

	public static function file_get_contents_curl( $url ) {
	  $ch = curl_init();
	  curl_setopt( $ch, CURLOPT_AUTOREFERER, TRUE );
	  curl_setopt( $ch, CURLOPT_HEADER, 0 );
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt( $ch, CURLOPT_URL, $url );
	  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
	  $data = curl_exec( $ch );
	  curl_close( $ch );
	  return $data;
	}

	/**
	 * Helper function : get local file content , alternative file_get_contents()
	 * @param  [string] $file_path
	 * @return [mixed]  file data
	 */
	public static function get_local_file_contents( $file_path ) {
	    ob_start();
	    include $file_path;
	    $contents = ob_get_clean();

	    return $contents;
	}

	public static function getPostType($post_type_name){
	$post_types = get_post_types( '', 'names' ); 
	if(array_search($post_type_name,$post_types)===false) return false; else return true;
	}

	public static function getSelectUsers($name,$tokenize=true,$maxElement=99999){
		if($tokenize) if($maxElement>1)	$class="tokenize"; else $class="tokenize-1";else $class="";	
		$args = array(	
				'exclude'      => array(get_current_user_id()),
				'orderby'      => 'login',
				'order'        => 'ASC',			
				'number'       => '99999',			
				'fields'       => 'all'		
		);
		$u=get_users( $args );
		if($u){
			$li=array('<option value=""></option>');
			foreach($u as $k=>$post){			
				$str='<option value="'.$post->ID.'">'.$post->display_name;
				$str.="</option>";
				$li[]=$str;
			}
			
			if(count($li)) return '<select  class="'.$class.'" name="'.$name.'" id="'.$name.'">'.implode("",$li).'</select>';
			else return false;
		}
	}


	public static function getSelectForType($type,$name,$tokenize=true,$maxElement=99999) {	
			if($tokenize) if($maxElement>1)	$class="tokenize"; else $class="tokenize-1";else $class="";
			
		$args=array(
				"post_type"=>$type,
				'posts_per_page'   => 99999,
		);	
		$posts=get_posts($args);
		if($posts){
			$li=array('<option value=""></option>');
			foreach($posts as $k=>$post){
				$str='<option value="'.$post->ID.'">'.$post->post_title;	
				if($type=="tealog") $str.=" &nbsp;(".get_field("street_address",$post->ID).",".ucfirst(get_field("city",$post->ID)).",".ucfirst(get_field("country",$post->ID)).")</option>";
				$li[]=$str;
			}
			return '<select class="'.$class.'" name="'.$name.'" id="'.$name.'">'.implode("",$li).'</select>';
			
		}
	}

	public static function getCheckboxesForTaxonomy( $taxonomy, $name, $allowed, $icon, $pretty, $categoryfilter ='' ) {	
		$terms = get_terms(	array(
					'taxonomy'	 => $taxonomy,
				 	'orderby'    => 'name',
				 	'order'      => 'DESC',
				 	'hide_empty' => 0, 	
				 	'include'	 => $allowed
				) );			
		if( $terms ) {		
			$li = array();
			foreach( $terms as $k => $term ) {
				if ( $icon == "true"){
					$term_image_url = get_term_meta( $term->term_id , 'locateanything_term_image_url', true );
					$term_image = '<div class="slug-'.$term->slug.' filter_term_image" style="background-image: url('.$term_image_url.')"></div>';
					$term_image_class = 'filters_image';
				} else {
					$term_image = '';
					$term_image_class = '';
				}
				$locateanything_checkbox_status = get_term_meta( $term->term_id , 'locateanything_checkbox_status', true );
				if ( $locateanything_checkbox_status == 'unchecked' ) { $status = ''; } else { $status = 'checked'; }
				if ( $categoryfilter ) {
					if ( $categoryfilter != $term->term_id ){ $status = ''; } else { $status = 'checked'; }
				}
				
				if( $pretty ) {
					$str = '<div id="la-filter-'.$term->term_id.'" class="LA_filters_checkbox '.$term_image_class.' pretty p-default"><input class="filter_term_checkbox" type="checkbox"  id="'.$name.'" name="'.$name.'[]" value="'.$term->term_id.'" '.$status.'>'.$term_image.'<div class="state p-primary"><label for="'.$name.'"></label></div><span class="filter_term_name">'.$term->name.'</span></div>';
				} else {
					$str = '<div id="la-filter-'.$term->term_id.'" class="LA_filters_checkbox '.$term_image_class.' "><input class="filter_term_checkbox" type="checkbox"  id="'.$name.'" name="'.$name.'[]" value="'.$term->term_id.'" '.$status.'>'.$term_image.'<span class="filter_term_name">'.$term->name.'</span></div>';
				}
				
				$li[] = $str;
			}
			if ( count($li) ) return implode( "", $li );
			else return false;
		}
	}

	public static function getCheckboxesForPostType($post_type,$name,$allowed,$icon,$pretty) {	
		$terms = get_posts(array(
			'posts_per_page'  => -1,
			'post_type' => $post_type,
		 	'orderby'    => 'name',
		 	'order'      => 'DESC',
		 	'hide_empty' => 0, 	
		 	'include'=>$allowed	
		));			
		if($terms){		
			$li=array();
			foreach($terms as $k=>$term){
				//var_dump($term);
				if ( $icon == "true"){
					$term_image_url = get_term_meta( $term->ID , 'locateanything_term_image_url', true );
					$term_image = '<div class="slug-'.$term->post_name.' filter_term_image" style="background-image: url('.$term_image_url.')"></div>';
					$term_image_class = 'filters_image';
				} else {
					$term_image = '';
					$term_image_class = '';
				}
				$locateanything_checkbox_status = get_term_meta( $term->ID , 'locateanything_checkbox_status', true );
				if (get_the_ID() != $term->ID) { $status = ''; } else { $status = 'checked'; }
				if($pretty) {
					$str='<div id="la-filter-'.$term->ID.'" class="LA_filters_checkbox '.$term_image_class.' pretty p-default"><input class="filter_term_checkbox" type="checkbox"  id="'.$name.'" name="'.$name.'[]" value="'.$term->ID.'" '.$status.'>'.$term_image.'<div class="state p-primary"><label for="'.$name.'"></label></div><span class="filter_term_name">'.$term->post_name.'</span></div>';
				}else {
					$str='<div id="la-filter-'.$term->ID.'" class="LA_filters_checkbox '.$term_image_class.' "><input class="filter_term_checkbox" type="checkbox"  id="'.$name.'" name="'.$name.'[]" value="'.$term->ID.'" '.$status.'>'.$term_image.'<span class="filter_term_name">'.$term->post_name.'</span></div>';
				}
				
				$li[]=$str;
			}
			//var_dump(get_the_ID());
			if(count($li)) return implode("",$li);
			else return false;
		}
	}

	public static function getSelectForTaxonomy($taxonomy,$name,$tokenize=true,$maxElement=99999,$allowed=false, $categoryfilter='') {
		if($tokenize) if($maxElement>1)	$class="tokenize"; else $class="tokenize-1";else $class="";

		$terms=get_terms($taxonomy , array(
	 	'orderby'    => 'name',
	 	'hide_empty' => 0,
	 	'include'=>$allowed) );		
		
		if($terms){

			$li=array('<option value=""></option>');
			foreach($terms as $k=>$term){
				if ( $categoryfilter == $term->term_id) { $status = 'selected="selected"';} else { $status ='';}
				$str='<option value="'.$term->term_id.'" '.$status.' >'.$term->name;
				$li[]=$str;
			}
			if(count($li)) return '<select class="'.$class.'" name="'.$name.'" id="'.$name.'">'.implode("",$li).'</select>';
			else return false;
		}
	}

	public static function findSomething($post_type,$taxonomies,$taxo_args=array(),$query_args=array(),$relation="OR"){		
			$args=array("post_type"=>$post_type);
			$conditions=array();
			global $query_string;
			$myquery = wp_parse_args($query_string);
			$paged=false;

			$myquery = array(
					'post_type'=>$post_type,
					'post_status' => 'publish',
					'paged'=>$paged,
					'numberposts'=>9999,
					'posts_per_page' => -1,
					'tax_query' => array('relation' => $relation)
			);
			
			foreach($query_args as $k=>$v) $myquery [$k]=$v;
			
			if(is_array($taxonomies))foreach($taxonomies as $taxonomy){
				if(isset($taxo_args[$taxonomy]) && !empty($taxo_args[$taxonomy])) $myquery['tax_query'][]=array('taxonomy' => $taxonomy,'terms' => $taxo_args[$taxonomy],'field' => 'term_id');
			}	

			$r=query_posts($myquery);
			return $r;
		
	}

	public static function getLocaleList(){
			return array(
		"af"=>"Afrikaans",
		"ak"=>"Akan",
		"sq"=>"Albanian",
		"am"=>"Amharic",
		"ar"=>"Arabic",
		"hy"=>"Armenian",
		"as"=>"Assamese",
		"asa"=>"Asu",
		"az"=>"Azerbaijani",
		"bm"=>"Bambara",
		"eu"=>"Basque",
		"be"=>"Belarusian",
		"bem"=>"Bemba",
		"bez"=>"Bena",
		"bn"=>"Bengali",
		"bs"=>"Bosnian",
		"bg"=>"Bulgarian",
		"my"=>"Burmese",
		"ca"=>"Catalan",		
		"zh"=>"Chinese",
		"kw"=>"Cornish",
		"hr"=>"Croatian",
		"cs"=>"Czech",
		"da"=>"Danish",
		"nl"=>"Dutch",
		"ebu"=>"Embu",
		"en"=>"English",
		"eo"=>"Esperanto",
		"et"=>"Estonian",
		"fo"=>"Faroese",
		"fil"=>"Filipino",
		"fi"=>"Finnish",		
		"fr"=>"French",
		"ff"=>"Fulah",
		"gl"=>"Galician",
		"lg"=>"Ganda",
		"ka"=>"Georgian",
		"de"=>"German",
		"el"=>"Greek",
		"gu"=>"Gujarati",
		"guz"=>"Gusii",
		"ha"=>"Hausa",
		"haw"=>"Hawaiian",
		"he"=>"Hebrew",
		"hi"=>"Hindi",
		"hu"=>"Hungarian",
		"is"=>"Icelandic",
		"ig"=>"Igbo",
		"id"=>"Indonesian",
		"ga"=>"Irish",
		"it"=>"Italian",
		"ja"=>"Japanese",
		"kea"=>"Kabuverdianu",
		"kab"=>"Kabyle",
		"kl"=>"Kalaallisut",
		"kln"=>"Kalenjin",
		"kam"=>"Kamba",
		"kn"=>"Kannada",
		"kk"=>"Kazakh",
		"km"=>"Khmer",
		"ki"=>"Kikuyu",
		"rw"=>"Kinyarwanda",
		"kok"=>"Konkani",
		"ko"=>"Korean",
		"khq"=>"Koyra Chiini",
		"ses"=>"Koyraboro Senni",
		"lag"=>"Langi",
		"lv"=>"Latvian",
		"lt"=>"Lithuanian",
		"luo"=>"Luo",
		"luy"=>"Luyia",
		"mk"=>"Macedonian",
		"jmc"=>"Machame",
		"kde"=>"Makonde",
		"mg"=>"Malagasy",
		"ms"=>"Malay",
		"ml"=>"Malayalam",
		"mt"=>"Maltese",
		"gv"=>"Manx",
		"mr"=>"Marathi",
		"mas"=>"Masai",
		"mer"=>"Meru",
		"mfe"=>"Morisyen",
		"naq"=>"Nama",
		"ne"=>"Nepali",
		"nd"=>"North Ndebele",
		"nb"=>"Norwegian Bokmål",
		"nn"=>"Norwegian Nynorsk",
		"nyn"=>"Nyankole",
		"or"=>"Oriya",
		"om"=>"Oromo",
		"ps"=>"Pashto",
		"fa"=>"Persian",
		"pl"=>"Polish",
		"pt"=>"Portuguese",
		"pa"=>"Punjabi",
		"ro"=>"Romanian",
		"rm"=>"Romansh",
		"rof"=>"Rombo",
		"ru"=>"Russian",
		"rwk"=>"Rwa",
		"saq"=>"Samburu",
		"sg"=>"Sango",
		"seh"=>"Sena",
		"sr"=>"Serbian",
		"sn"=>"Shona",
		"ii"=>"Sichuan Yi",
		"si"=>"Sinhala",
		"sk"=>"Slovak",
		"sl"=>"Slovenian",
		"xog"=>"Soga",
		"so"=>"Somali",
		"es"=>"Spanish",
		"sw"=>"Swahili",
		"sv"=>"Swedish",
		"gsw"=>"Swiss German",
		"shi"=>"Tachelhit",
		"dav"=>"Taita",
		"ta"=>"Tamil",
		"te"=>"Telugu",
		"teo"=>"Teso",
		"th"=>"Thai",
		"bo"=>"Tibetan",
		"ti"=>"Tigrinya",
		"to"=>"Tonga",
		"tr"=>"Turkish",
		"uk"=>"Ukrainian",
		"ur"=>"Urdu",
		"uz"=>"Uzbek",
		"vi"=>"Vietnamese",
		"vun"=>"Vunjo",
		"cy"=>"Welsh",
		"yo"=>"Yoruba",
		"zu"=>"Zulu");
		
	}


	public static function textbox($name,$title,$css,$values) {
			if(!is_array($values)) $values=array();
		return $title.'&nbsp;<input type="text"  '.$css.' name="'.$name.'" value="'.$values[$name].'" id="'.str_replace('[]','',$name).'">';
	}

	public static function hidden($name,$values) {	
			if(!is_array($values)) $values=array();
		return $title.' <input type="hidden"   name="'.$name.'" value="'.$values[$name].'" id="'.str_replace('[]','',$name).'"> ';
	}

	public static function textarea($name,$title,$css,$values) {
			if(!is_array($values)) $values=array();
		return $title.' <textarea  '.$css.' id="'.str_replace('[]','',$name).'" name="'.$name.'">'.$values[$name].' </textarea>';
	}

	public static function checkbox($name,$title,$css,$value,$values) {
		if(!is_array($values)) $values=array();	
		if(empty($value)) return '';

		if ($values[$name] == $value)   $selected = 'checked="checked"';  else $selected = "";
		return '<input type="checkbox" value="'.$value.'" '.$css.' name="'.$name.'" '.$selected.' id="'.str_replace('[]','',$name).'">&nbsp;'.$title;
	}

	public static function checkboxMultiple($name,$title,$css,$value,$values) {
		if(!is_array($values)) $values=array();	
		if(empty($value)) return '';
		if ($values[$value] == $value)   $selected = 'checked="checked"';  else $selected = "";

		return '<input type="checkbox" value="'.$value.'" '.$css.' name="'.$name.'" '.$selected.' id="'.str_replace('[]','',$name).'">&nbsp;'.$title;
	}

	public static function radio($name,$value,$title,$css,$values) {	
			if(!is_array($values)) $values=array();
		if ($values[$name] == $value)   $selected = 'checked="checked"';  else $selected = "";
		return '<input type="radio" '.$css.' value="'.$value.'" name="'.$name.'" '.$selected.' id="'.str_replace('[]','',$name).'"> '.$title;
	}

	public static function Array2Select($myarray, $name,$itemSelected = false,$params=''){
			if(!is_array($myarray)) return;
			if($itemSelected){
				if(is_array($itemSelected)){
					$itemsSelected=$itemSelected;
				}else $itemsSelected=array($itemSelected);
			}
			$strOutput = "<select  name=\"$name\" id=\"$name\" $params>";
			foreach ($myarray as $key => $val) {
				if ($itemSelected != false && array_search($key,$itemsSelected)!==false) {
					$selText = "selected";
				} else $selText = "";			
				$strOutput .= "<option  value=\"" . $key . "\" $selText >".stripslashes($val)."</option>";
			}
			$strOutput .= "</select>";
			return $strOutput;
	}

	public static function Order_Filters( $filters, $type, $map_id ) {
		$sort = array();
		$filters_ = array();	
		if (is_array ( $filters ) && $type!=="user") {
			foreach ( $filters as $key => $filter ) {
				$filter_selector_sort = get_post_meta ( $map_id, 'locate-anything-filter-selector-sort-' . $filter, true );
				if ( $filter ) {
					$filters_[$filter] = $filter_selector_sort;
				}
			}
			asort($filters_);
		}
		return $filters_;
	}



}
?>