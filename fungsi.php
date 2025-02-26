<?php

function can_access_menu($menu){
    if($_SESSION['apriori_level']==2 & ($menu=='hasil_rule' || $menu=='view_rule')){
        return true;
    }
    if($_SESSION['apriori_level']==1){
        return true;
    }
    return false;
}

//---------------------------------------------------------------------------------
/**
 * peringatan popup javascript
 * @param string $msg pesan
 */
function phpAlert($msg){
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

/**
 * notifikasi error (merah)
 * @param string $msg pesan
 */
function display_error($msg){
    echo "<div class='alert alert-danger alert-dismissable text-center'>
            ".$msg."
        </div>";
}

/**
 * notifikasi warning (kuning)
 * @param string $msg pesan
 */
function display_warning($msg){
    echo "<div class='alert alert-warning alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            ".$msg."
          </div>";
}

/**
 * notifikasi informasi (biru)
 * @param string $msg pesan
 */
function display_information($msg){
    echo "<div class='alert alert-info alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            ".$msg."
          </div>";
}

/**
 * notifikasi sukses (hijau)
 * @param string $msg pesan
 */
function display_success($msg){
    echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ".$msg."
                  </div>";
}

/**
 * enter br with looping
 * @param int $a default=1
 */
function br($a=1){
	if($a>=1){
		$aa=0;
		while($aa<=$a){
			echo "<br>";
			$aa++;
		}
	}
}

/**
 * spasi &nbsp; with looping
 * @param int $a default=1
 */
function space($a=1){
	if($a>=1){
		$aa=0;
		while($aa<=$a){
			echo "&nbsp;";
			$aa++;
		}
	}
}

/**
 * start div
 * @param string $params default=''
 */
function start_div($params=''){
	echo "<div $params>";
}

/**
 * end div
 */
function end_div(){
	echo "</div>";
}

/**
 * start form
 * @param string $params default=''
 */
function start_form($params=''){
	echo "<form action='' method='post' $params>";
}

/**
 * end form
 */
function end_form(){
	echo "</form>";
}

/**
 * table start
 * @param string $params default=''
 */
function start_table($params=''){
	echo "<table $params>";
}

/**
 * end table
 */
function end_table(){
	echo "</table>";
}

/**
 * echo tr $params;
 * @param string $params default=''
 */
function start_row($params=''){
	echo "<tr $params>";
}

/**
 * echo /tr
 */
function end_row(){
	echo "</tr>";
}

/**
 * echo td $params;
 * @param string $params default=''
 */
function start_column($params=''){
	echo "<td $params>";
}

/**
 * echo /td
 */
function end_column(){
	echo "</td>";
}


/**
 * label text
 * @param string $label default=''
 * @param type $params parameter tambahan default=''
 */
function label($label='', $params=''){
	echo "<label for='name' $params >".$label;//.<!-- <span class="red">(required)</span> --></label>"
	echo "</label>";
}

/**
 * input text area
 * @param string $name
 * @param string $value
 * @param boolean $required
 * @param string $params default=''
 * @param boolean $texteditor text area dengan tinymce default=false
 */
function input_text_area($name,$value, $required=false, $params='', $texteditor=false){
    $tinymce = "mceNoEditor";
    if($texteditor){
        $tinymce = "mceEditor";
    }
    if(!$required){
        echo "<textarea name='$name' rows='10' cols='80' $params>".$value."</textarea>";
    }
    else{
        echo "<textarea name='$name' required='required' class='form-control $tinymce' $params>".$value."</textarea>";
    }
}

/**
 * input text area with label
 * @param type $label
 * @param type $name
 * @param type $value
 * @param type $required
 * @param type $params
 * @param boolean $texteditor textarea dengan tinymce default=false
 */
function text_area($label='', $name='', $value=null, $required=false, $params='', $texteditor=false)
{
    //template bootstrap tanpa row and column
			label($label);
			input_text_area($name, $value, $required, $params, $texteditor);
}

/**
 * password field one row (for form input)
 * @param string $label default=''
 * @param string $name default=''
 * @param string $value default=''
 * @param boolean $required default=false
 * @param string $params default=''
 */
function password_field($label='', $name='', $value='', $required=false, $params='')
{
    //template bootstrap tanpa row and column
			label($label);
			input_password_text($name, $value, $required, $params);
}

/**
 * text field one row (for form input)
 * @param string $label default=''
 * @param string $name default=''
 * @param string $value default=''
 * @param boolean $required default=false
 * @param string $params default=''
 */
function text_field($label='', $name='', $value='', $required=false, $params='')
{
    //template bootstrap tanpa row and column
			label($label);
			input_free_text($name, $value, $required, $params);
}

/**
 * text input tipe file
 * @param type $label
 * @param type $name
 * @param type $required
 * @param type $params
 */
function text_input_file($label='', $name='', $required=false, $params=''){
    label($label);
    input_file($name, $required, $params );
}

/**
 * amount field one row (for form input) harga
 * @param string $label default=''
 * @param string $name default=''
 * @param string $value default=''
 * @param boolean $required default=false
 * @param string $params default=''
 */
function amount_field($label='', $name='', $value='', $required=false, $params='')
{
    //template bootstrap tanpa row and column
			label($label);
			input_amount_text($name, $value, $required, $params);
}


/**
 * text label one row (for form input with input hidden type)
 * @param string $label label text tulisan
 * @param string $name name hidden form
 * @param string $id_value value hidden
 * @param string $value nilai dari label (akan muncul disamping label)
 * @param string $params parameter tambahan di hidden form
 */
function text_label_with_hidden($label='', $name='', $id_value='', $value=null, $params='')
{
    //template bootstrap tanpa row and column
			label($label);
                    space(2);
                    echo $value;
                    input_hidden($name, $id_value, $params);
}

/**
* text table one cell (for table display)
**/
function text_cell($text='', $params='')
{
	start_column($params);
	echo $text;
	end_column();
}

/**
* space kolom table one cell (for table display)
**/
function space_cell($params='')
{
	start_column($params);
	echo "&nbsp;";
	end_column();
}

/**
* head table parameter harus diisi array
 * 
**/
function head_table($head, $thead=false){
    if($thead){
        echo "<thead>";
    }
	start_row();
	foreach ($head as $val => $value) {
		echo "<th>".$value."</th>";
	}
	end_row();
    if($thead){
        echo "</thead>";
    }
}

/**
 * foot table parameter harus diisi array
 * @param type $head
 * @param type $thead
 */
function foot_table($head, $thead=false){
    if($thead){
        echo "<tfoot>";
    }
	start_row();
	foreach ($head as $val => $value) {
		echo "<th>".$value."</th>";
	}
	end_row();
    if($thead){
        echo "</tfoot>";
    }
}

/**
 * edit dan delete link button(for table display)
 * @param type $table
 * @param type $id
 * @param type $parameter_key
 * @param type $path_to_root
 * @param type $parent_menu headmenu parameter get
 */
function edit_delete_link($table, $id, $parameter_key, $path_to_root, $parent_menu){
	start_column("align='center' ");
        edit_link($table, $id, $parameter_key, $path_to_root, $parent_menu);
//	echo " | ";
        delete_link($table, $id, $parameter_key, $path_to_root, $parent_menu);
	end_column();
}

/**
 * edit link
 * @param type $table
 * @param type $id
 * @param type $parameter_key
 * @param type $path_to_root
 * @param type $parent_menu headmenu parameter get
 */
function edit_link($table, $id, $parameter_key, $path_to_root, $parent_menu){
    echo "<a href='?".$parameter_key."kd_tabel=$table&headmenu=$parent_menu&update=$id' class='btn bg-olive btn-sm margin' data-toggle='tooltip' title='Edit' >"
            . "<i class='glyphicon glyphicon-edit' ></i>"
            . "</a>";
}

/**
 * delete link
 * @param type $table
 * @param type $id
 * @param type $parameter_key
 * @param type $path_to_root
 * @param type $parent_menu headmenu parameter get
 * @param type $params tambahan parameter get
 */
function delete_link($table, $id, $parameter_key, $path_to_root, $parent_menu, $params=''){
    $prm='';
    if(!empty($params)){
        $prm = "&".$params;
    }
    echo "<a href='?".$parameter_key."kd_tabel=$table&headmenu=$parent_menu&delete=".$id.$prm."' onclick=\"return confirm('Apakah anda yakin?')\" class='btn btn-danger btn-sm' data-toggle='tooltip' title='Delete'>"
            . "<i class='glyphicon glyphicon-remove-sign' ></i>"
            . "</a> ";
}

/**
 * kolom link text
 * @param type $link
 * @param type $label
 * @param type $params
 */
function colom_link_text($link, $label, $params=''){
        start_column("align='center' ");
        link_text($link, $label, $params);
	end_column();
}

/**
 * input type password
 * @param type $name
 * @param type $value
 * @param type $required
 * @param type $params
 */
function input_password_text($name,$value, $required=true, $params=''){
	
	if(!$required){
		echo "<input type='password'  name='$name' 
			value='$value' class='form-control' $params/>";
	}
	else{
		echo "<input type='password' name='$name' 
			value='$value' required='required' class='form-control' $params/>";
	}
}

/**
 * input type text
 * @param type $name
 * @param type $value
 * @param type $required
 * @param type $params
 */
function input_free_text($name,$value, $required=true, $params=''){
	
	if(!$required){
		echo "<input type='text'  name='$name' 
			value='$value' class='form-control' $params/>";
	}
	else{
		echo "<input type='text' name='$name' 
			value='$value' required='required' class='form-control' $params/>";
	}
}

/**
 * input tipe file
 * @param type $name
 * @param type $required
 * @param type $params
 */
function input_file($name, $required=false, $params=''){
    if(!$required){
        echo "<input type='file' name='$name' $params>";
    }
    else{
        echo "<input type='file' name='$name' required='required' $params>";
    }
}

/**
 * input type amount (harga)
 * @param type $name
 * @param type $value
 * @param type $required
 * @param type $params
 */
function input_amount_text($name,$value, $required=true, $params=''){
	
        $value = price_format($value);
	if(!$required){
		echo "<input type='text'  name='$name' 
			value='$value' onkeyup=\"convertToPrice(this);\" class='form-control' $params/>";
	}
	else{
		echo "<input type='text' name='$name' 
			value='$value' onkeyup=\"convertToPrice(this);\" required='required' class='form-control' $params/>";
	}
}

/**
 * input type hidden
 * @param type $name
 * @param type $value
 * @param type $params default = ''
 */
function input_hidden($name, $value, $params=''){
	echo "<input type='hidden' id='$name' name='$name' value='$value' $params/>";
}

/**
 * input type date
 * @param type $name
 * @param type $value
 * @param type $tittle
 * @param type $id
 */
function input_date($name, $value, $tittle='', $id='date-picker'){
	echo "<input type='text' id='$id'  name='$name' size='10' maxlength='10' 
			value='$value' tittle ='$tittle' />";	
}

/**
 * submit button with reset button
 * @param type $name
 * @param type $value
 */
function submit_form_button($name, $value){
	echo "<input type='submit' name='$name' value='$value' >";
	echo "<input type='reset' value='Reset'>";
}

/**
 * submit button 
 * @param type $name
 * @param type $value
 * @param type $params default=''
 */
function submit_button($name, $value, $params=''){
	echo "<button name='$name' value='$value' $params >$value</button>";
	// echo "<input type='submit' name='$name' value='$value' >";
}

/**
 * link dengan popup new window open
 * @param type $label
 * @param type $link
 */
function link_new_window($label, $link){
	echo  "<a href='$link' target='_blank' onclick=\"window.open(this.href); return false;\" 
	 onkeypress=\"window.open(this.href); return false;\">$label</a>";
}

/**
 * tulisan untuk link ke suatu halaman
 * @param type $link
 * @param type $label
 * @param type $params
 */
function link_text($link, $label, $params='')
{
	echo "<a href='$link' $params />$label</a>";
}

/**
 * format number 2 dibelakang koma (number_format($value,2)
 * @param type $value
 * @return type
 */
function price_format($value){
	return number_format($value,2, ',', '.');
}

// cetak link
function print_cetak(){
    echo "<a href=\"javascript:window.print()\">Cetak</a>";
}

function format_date($date){
    $date_ex = explode("/", $date);
    return $date_ex[2]."-".$date_ex[1]."-".$date_ex[0];
}

function format_date2($date){
    $date_ex = explode("-", $date);
    return $date_ex[2]."/".$date_ex[1]."/".$date_ex[0];
}

function format_date_db($date){
    $date_ex = explode("-", $date);
    return $date_ex[2]."-".$date_ex[1]."-".$date_ex[0];
}

?>