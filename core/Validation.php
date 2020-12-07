<?php


namespace Core;


class Validation
{
    public array $formData;
    public array $rules;

    private array $errors = [];

    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_UNIQUE = 'unique';

    /**
     * Validation constructor.
     * @param array $formData
     * @param array $rules
     */
    public function __construct(array $formData, array $rules)
    {
        $this->formData = $formData;
        $this->rules = $rules;
    }

    public function validate()
    {
        $formData = $this->formData;
        foreach ($this->rules as $fieldAttribute => $rules) {
            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (is_array($rule)) {
                    $ruleName = array_key_first($rule);
                }
                switch ($ruleName) {
                    case self::RULE_REQUIRED:
                        if (empty($formData[$fieldAttribute])) {
                            $this->setErrors($fieldAttribute, self::RULE_REQUIRED, 'Поле необходимо заполнить');
                        }
                        break;
                    case self::RULE_EMAIL:
                        if (!empty($formData[$fieldAttribute]) && !filter_var($formData[$fieldAttribute], FILTER_VALIDATE_EMAIL)) {
                            $this->setErrors($fieldAttribute, self::RULE_EMAIL, 'Введен некорректный емайл адрес');
                        }
                        break;
                    case self::RULE_UNIQUE:
                        $class = new $rule['unique'];

                        if (!$class instanceof \Illuminate\Database\Eloquent\Model) {
                            return 0;
                        }

                        if (!empty($formData[$fieldAttribute]) && $class->firstWhere($fieldAttribute, $formData[$fieldAttribute])) {
                            $this->setErrors($fieldAttribute, self::RULE_UNIQUE, 'Введено неуникальное значение');
                        }
                        break;
                }
            }
        }
    }

    /**
     * @param string $fieldAttribute
     * @param string $ruleName
     * @param string $message
     */
    public function setErrors(string $fieldAttribute, string $ruleName, string $message)
    {
        $this->errors[$fieldAttribute][$ruleName] = $message;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        if (count($this->errors) > 0) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}