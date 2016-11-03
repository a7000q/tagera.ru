<?
    switch ($field->typeField->name)
    {
        case "text":
            $view = 'field-text';
            break;
        case "textarea":
            $view = 'field-textarea';
            break;
        case "select":
            $view = 'field-select';
            break;
        case "radio":
            $view = 'field-radio';
            break;
        case "checkbox":
            $view = 'field-checkbox';
            break;
    }

    echo $this->render($view, ['form' => $form, 'field' => $field, 'model' => $model]);
?>