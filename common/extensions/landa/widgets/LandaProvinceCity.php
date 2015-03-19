<?php
class LandaProvinceCity extends CWidget {
    public $name;
    public $disabled;
    public $cityValue;
    public $provinceValue;
    public $prefix;
    public $width;
    public $label;

    public function run() {
        if (empty($this->prefix))
            $this->prefix = "";
        $name = $this->name;
        $cityValue = $this->cityValue;
        $provinceValue = $this->provinceValue;
        $disabled = $this->disabled;
        $id = str_replace(" ", "_", $name);
        $label = (empty($this->label))?'City':$this->label;
        $data ='';
        $width = (empty($this->width))?"30%":$this->width;

        $data .= '<div class="control-group ">';
        $data .= '<label class="control-label" for="' . $name . '">'.$label.'<span class="text-error"> *</span></label>';
        $data .= '<div class="controls" id="cityq_' . $id . '">';
        $city = City::model()->listCity();
        $data .= $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => $this->prefix . $name,
            'value' => $cityValue,
            'data' => CHtml::listData($city, 'id', 'fullName'),
            'htmlOptions' => array(
                'disabled' => $disabled
            ),
            'options' => array(
                'width' => $width,
            )), true);


        $data .= '</div></div>';
        echo $data;
    }

}
?>




