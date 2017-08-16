<?php
function fileNaming($names) {
    $result = [];
    foreach ($names as $name) {
        if (!in_array($name, $result, true)) {
            $result[] = $name;
        } else {
            $result[] = getName($result, $name);
        }
    }

    return $result;
}

function getName($result, $name, &$count = 1) {
    if ($count === 1) {
        $name = $name . '(' . $count . ')';
    } else {
        $name = preg_replace('/(.*)\(\d+\)$/', '$1(' . $count. ')', $name);
    }

    if (!in_array($name, $result, true)) {
        return $name;
    } else {
        $count++;
        return getName($result, $name, $count);
    }
}

$names = ["doc",
    "doc",
    "image",
    "doc(1)",
    "doc"];
var_dump(fileNaming($names));

