<?php
namespace CrazyCodr\Iterators;

/**
 * PreviousCurrentIterator returns the previous and current item as it iterators, perfect to compare
 * items that are stringed in a sequence such as historical or sequenced elements to compare to each other.
 *
 * Warning, this assumes that you have a previous and current. If you can't be sure that you have at least 2 items,
 * use the CurrentNextIterator which allows for Next to be null.
 *
 * @package CrazyCodr\Iterators
 */
class PreviousCurrentIterator implements \Iterator
{

	/**
	 * Contains the items to iterate over
	 *
	 * @var array
	 */
	private $items = [];

	/**
	 * Contains the previous items (previous current) to compare with the real current
	 * @var mixed
	 */
	private $previousItem = null;

	/**
	 * Contains the previous key to compare with the current key
	 * @var null
	 */
	private $previousKey = null;

	/**
	 * Contains the previous items (previous current) to compare with the real current
	 * @var mixed
	 */
	private $currentItem = null;

	/**
	 * Contains the previous key to compare with the current key
	 * @var null
	 */
	private $currentKey = null;

	/**
	 * @param array $data
	 */
	public function __construct(array $data) {
		$this->items = $data;
	}

	/**
	 * @inheritedDoc
	 */
	public function current() {
		return [
			'previous' => $this->previousItem,
			'current'  => $this->currentItem
		];
	}

	/**
	 * @inheritedDoc
	 */
	public function next() {
		$this->previousItem = current($this->items);
		$this->previousKey = key($this->items);
		next($this->items);
		$this->currentItem = current($this->items);
		$this->currentKey = key($this->items);
	}

	/**
	 * @inheritedDoc
	 */
	public function key() {
		return [
			'previous' => $this->previousKey,
			'current'  => $this->currentKey
		];
	}

	/**
	 * @inheritedDoc
	 */
	public function valid() {
		return $this->previousKey !== null && $this->currentKey !== null;
	}

	/**
	 * @inheritedDoc
	 */
	public function rewind() {
		reset($this->items);
		$this->next();
	}

}