<?php

global $mf_domain;

// initialisation

class multiline_field extends mf_custom_fields {

  public $allow_multiple = TRUE;
  public $has_properties = TRUE;

    function get_properties() {
    return  array(
      'js'  => TRUE,
      'js_dependencies' => array(), 
      'css' => FALSE
    );
  }

  public function _update_description(){
    global $mf_domain;
    $this->description = _("Multiline field",$mf_domain);
  }
  
  public function _options() {
    global $mf_domain;
    
    $data = array(
      'option'  => array(
        'height'  => array(
          'type'        =>  'text',
          'id'          =>  'multiline_height_',
          'label'       =>  __('Height',$mf_domain),
          'name'        =>  'mf_field[option][height]',
          'default'     =>  '',
          'description' =>  '',
          'value'       =>  '3',
          'div_class'   => '',
          'class'       => ''
        ),
        'width'  => array(
          'type'        =>  'text',
          'id'          =>  'multiline_width',
          'label'       =>  __('Width',$mf_domain),
          'name'        =>  'mf_field[option][width]',
          'default'     =>  '',
          'description' =>  '',
          'value'       =>  '23',
          'div_class'   => '',
          'class'       => ''
        ),
        'hide_visual'  => array(
          'type'        =>  'checkbox',
          'id'          =>  'multiline_hide_visual',
          'label'       =>  __('Hide Visual Editor for this field',$mf_domain),
          'name'        =>  'mf_field[option][hide_visual]',
          'description' =>  '',
          'value'       =>  '',
          'div_class'   => '',
          'class'       => ''
        ),
        'max_length'  => array(
          'type'        =>  'checkbox',
          'id'          =>  'multiline_max_length',
          'label'       =>  __('Max Length',$mf_domain),
          'name'        =>  'mf_field[option][max_length]',
          'description' =>  __('If set, Hide Visual Editor for this field',$mf_domain),
          'value'       =>  '',
          'div_class'   => '',
          'class'       => ''
        )
      )
    );

    return $data;
  }

    public function display_field( $field, $group_index = 1, $field_index = 1 ) {
    global $mf_domain;


    $class = '';
    $max = '';
    if( $field['options']->max_length ){
      $max = sprintf('maxlength="%d"',$field['options']->height*$field['options']->width);
    }
    $value = $field['input_value'];

    $output = '';
    $output .= '<div class="multiline_custom_field">';
    if($field['options']->hide_visual == 0 && user_can_richedit() ){
      $output .= sprintf('<div class="tab_multi_mf">');
      $output .= sprintf('<a onclick="del_editor(\'%s\');" class="edButtonHTML_mf">HTML</a>',$field['input_id']);
      $output .= sprintf('<a onclick="add_editor(\'%s\');" class="edButtonHTML_mf current" >Visual</a>',$field['input_id']);
      $output .= sprintf('</div>');
      $class = 'pre_editor add_editor';
      //falta agregar validacion para dejar p y br
      $value = apply_filters('the_editor_content', $value);
    }
    $output .= sprintf('<textarea %s class="mf_editor %s" tabindex="3"  id="%s" name="%s" rows="%s" cols="%s" %s >%s</textarea>',$field['input_validate'],$class,$field['input_id'],$field['input_name'],$field['options']->height,$field['options']->width,$max,$value);
    $output .= '</div>';

    return $output;
  }
}
?>
