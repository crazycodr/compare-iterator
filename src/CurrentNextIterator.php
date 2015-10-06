<?php
namespace CrazyCodr\Iterators;

/**
 * CurrentNextIterator returns the previous and current item as it iterators, perfect to compare
 * items that are stringed in a sequence such as historical or sequenced elements to compare to each other.
 *
 * Note that CurrentNextIterator returns NULL in next if you get to the end or if there is only 1 item in the array.
 *
 * @package CrazyCodr\Iterators
 */
class CurrentNextIterator implements \Iterator
{

	/**
	 * Contains the items to iterate over
	 *
	 * @var array
	 */
	private $items = [];

	/**
	 * Contains the current item (previous current) to compare with the next
	 * @var mixed
	 */
	private $currentItem = null;

	/**
	 * Contains the current key to compare with the current key
	 * @var null
	 */
	private $currentKey = null;

	/**
	 * Contains the next item (next current) to compare with the real current
	 * @var mixed
	 */
	private $nextItem = null;

	/**
	 * Contains the next key to compare with the current key
	 * @var null
	 */
	private $nextKey = null;

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
			'current' => $this->currentItem,
			'next'  => $this->nextItem
		];
	}

	/**
	 * @inheritedDoc
	 */
	public function next() {
		$this->currentItem = current($this->items);
		$this->currentKey = key($this->items);
		next($this->items);
		$this->nextItem = current($this->items);
		$this->nextKey = key($this->items);
		if($this->nextItem === false)
		{
			$this->nextItem = null;
			$this->nextKey = null;
		}
	}

	/**
	 * @inheritedDoc
	 */
	public function key() {
		return [
			'previous' => $this->currentKey,
			'current'  => $this->nextKey
		];
	}

	/**
	 * @inheritedDoc
	 */
	public function valid() {
		return $this->currentKey !== null;
	}

	/**
	 * @inheritedDoc
	 */
	public function rewind() {
		reset($this->items);
		$this->next();
	}

}