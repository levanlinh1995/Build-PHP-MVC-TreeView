<?php

namespace App\Classes;

use App\Interfaces\abstractTreeView;
use App\Models\TreeEntry;

/**
 * Implement your code here
 * Feel free to remove the echos :)
 */

class myTreeView extends abstractTreeView 
{
	
	public function showCompleteTree() 
	{
		$entryList =  (new TreeEntry)->getAll();
		$dataTree = buildTreeRecursively($entryList);
		
		return $dataTree;
	}
	
	public function showAjaxTree() 
	{
		$children =  (new TreeEntry)->getChildrenById(0);
		return $children;
	}
	
	public function fetchAjaxTreeNode($entry_id) 
	{
		$children =  (new TreeEntry)->getChildrenById($entry_id);
		return $children;
	}
}