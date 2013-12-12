<?php

class __Mustache_ae072cdf9646700255901dd7b7fba727 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . 'Hello, ';
        $value = $this->resolveValue($context->find('name'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '!';

        return $buffer;
    }
}
