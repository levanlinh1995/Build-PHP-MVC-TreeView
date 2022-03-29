<?php

namespace App\Classes;

use App\Interfaces\abstractTreeView;
use App\Models\TreeEntry;

/**
 * Implement your code here
 * Feel free to remove the echos :)
 */

class myTreeView extends abstractTreeView {
	
	public function showCompleteTree() {

		$entryList =  (new TreeEntry)->getAll();
		$tree = buildTreeRecursively($entryList);
		
		return $tree;
	}
	
	public function showAjaxTree() {
		echo 'Show Ajax Tree<br>';
	}
	
	public function fetchAjaxTreeNode($entry_id) {
		echo 'fetchAjaxTreeNode for entry_id ('.$entry_id.')<br>';
	}
}