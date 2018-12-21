<?php
namespace MikadoListing\Lib\FieldCreator;

class ListingFieldCreator{

	private $id;
	private $type;
	private $label;
	private $options;
	private $required;
	private $placeholder;
	private $priority;
	private $description;
	private $multiple;
	private $front_end_field;
	private $back_end_field;

	public function __construct($id = '', $type = '', $label = '', $options = array(), $required = false,$placeholder = '',$priority = '',$description = '',$multiple = false, $front_end_field = true , $back_end_field = true){

		$this->id = $id;
		$this->type = $type;
		$this->label = $label;
		$this->options = $options;
		$this->required = $required;
		$this->placeholder = $placeholder;
		$this->priority = $priority;
		$this->description = $description;
		$this->multiple = $multiple;
		$this->front_end_field = $front_end_field;
		$this->back_end_field = $back_end_field;


		if($this->front_end_field){
			add_filter('submit_job_form_fields', array($this, 'create_front_end_field'));
		}
		if($this->back_end_field){
			add_filter('job_manager_job_listing_data_fields', array($this, 'create_back_end_field'));
		}
	}

	public function create_front_end_field($fields){

		$fields['job'][$this->id] = array(
			'label'       => $this->label,
			'options'     => $this->options,
			'type'        => $this->type,
			'multiple'    => $this->multiple,
			'required'    => $this->required,
			'placeholder' => $this->placeholder,
			'priority'    => (int)$this->priority
		);

		return $fields;

	}
	public function create_back_end_field($fields){
		$fields['_'.$this->id] = array(
			'label'       => $this->label,
			'options'     => $this->options,
			'type'        => $this->type,
			'multiple'    => $this->multiple,
			'placeholder' => $this->placeholder,
			'description' => $this->description,
			'priority'    => (int)$this->priority
		);

		return $fields;

	}

}