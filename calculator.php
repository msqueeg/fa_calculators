<?php
namespace calculator;

interface OperationInterface
{
	public function evaluate(array $operands = array());
}

class Calculator
{
	protected $operands = array();

	public function setOperands(array $operands = array())
	{
		$this->operands = $operands;
	}

	public function setOperation(OperationInterface $operation)
	{
		$this->operation = $operation;
	}

	public function process()
	{
		return $this->operation->evaluate($this->operands);
	}

}

class Addition implements OperationInterface
{
	public function evaluate(array $operands = array())
	{
		return array_sum($operands);
	}
}

class Subtraction implements OperationInterface
{
	public function evaluate(array $operands = array())
	{
		return $operands[0] - $operands[1];
	}
}

class Multiplication implements OperationInterface
{
	public function evaluate(array $operands = array())
	{
		return $operands[0] * $operands[1];
	}
}

class Division implements OperationInterface
{
	public function evaluate(array $operands = array())
	{
		return
	}
}
echo = date('Y');

