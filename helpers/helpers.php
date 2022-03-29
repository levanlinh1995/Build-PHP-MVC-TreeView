<?php

if (!function_exists('buildTreeRecursively'))
{
    function buildTreeRecursively($elements, $parentId = 0)
    {
        $branch = [];
    
        foreach ($elements as $element) {
            if ($element['parent_entry_id'] == $parentId) {
                $children = buildTreeRecursively($elements, $element['entry_id']);
    
                if ($children) {
                    $element['children'] = $children;
                }
    
                $branch[] = $element;
            }
        }
    
        return $branch;
    }
}