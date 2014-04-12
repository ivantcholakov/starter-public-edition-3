<?php

class __Mustache_e31d988f256d18b2e5d2d50d5c29760d extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<table class="table table-bordered table-striped">
';
        $buffer .= $indent . '    <thead>
';
        $buffer .= $indent . '        <tr>
';
        $buffer .= $indent . '            <th>Code</th>
';
        $buffer .= $indent . '            <th>Name</th>
';
        $buffer .= $indent . '            <th>Flag</th>
';
        $buffer .= $indent . '        </tr>
';
        $buffer .= $indent . '    </thead>
';
        $buffer .= $indent . '    <tbody>
';
        $buffer .= $indent . '        ';
        // 'data' section
        $buffer .= $this->section10d36484894c082a31e11597f5a9fbef($context, $indent, $context->find('data'));
        $buffer .= '
';
        $buffer .= $indent . '    </tbody>
';
        $buffer .= $indent . '</table>
';

        return $buffer;
    }

    private function section10d36484894c082a31e11597f5a9fbef(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '<tr>
            <td>{{code}}</td>
            <td>{{name}}</td>
            <td><img class="thumbnail" src="{{BASE_URI}}assets/img/lib/flags-iso/flat/32/{{code}}.png" /></td>
        </tr>';
            $buffer .= $this->mustache
                ->loadLambda((string) call_user_func($value, $source, $this->lambdaHelper))
                ->renderInternal($context);
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                $buffer .= '<tr>
';
                $buffer .= $indent . '            <td>';
                $value = $this->resolveValue($context->find('code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</td>
';
                $buffer .= $indent . '            <td>';
                $value = $this->resolveValue($context->find('name'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</td>
';
                $buffer .= $indent . '            <td><img class="thumbnail" src="';
                $value = $this->resolveValue($context->find('BASE_URI'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= 'assets/img/lib/flags-iso/flat/32/';
                $value = $this->resolveValue($context->find('code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '.png" /></td>
';
                $buffer .= $indent . '        </tr>';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
