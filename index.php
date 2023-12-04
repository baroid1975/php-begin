<?php

$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

// Задание #1
 //!!!  через функции explode разделение ФИО
$fullname = "Иванов Иван Иванович";   
function getWordsFromFullname($fullname) {
      $words = explode(' ', $fullname);
    return  [
        'surname' => $words[0],
        'name' => $words[1],
        'patronymic'=> $words[2],
    ];
}
//print_r(getWordsFromFullname($fullname));

// Задание #2
//!!!через implode  склеивание

$fullname = array("Иванов","Иван","Иванович");
$surname = "Иванов";
$name = "Иван";
$patronymic = "Иванович";
function getFullnameFromWords ($surname,  $name , $patronymic) {
return "$surname $name $patronymic";
}
//print_r(getFullnameFromWords($surname, $name ,$patronymic));



// Задание #3
// функция getShortName. Сокращение ФИО.

//Определяю пол только по отчеству
$fullname = "Иванов Иван Иванович";
function getShortName ($fullname, $format="A b. c.") {
    $words = explode(" ", $fullname);
    $fullname  = array("A", "B", "C");
    $short_name = $format . '.';
    foreach ($fullname  as $index => $word) {
        $short_name = str_replace($word, $words[$index], $short_name);
        $short_name = str_replace(mb_strtolower($word), mb_substr($words[$index], 0, 1), $short_name);
    }
    return $short_name;
}
//echo getShortName ($fullname, 'B c'); 

// Задание #4
//Функция определения пола по ФИО

function getGenderFromName($fullname){
 
    $words = getWordsFromFullname($fullname);
    $gender = 0; 
       // мужской пол
      if (mb_substr($words['surname'], -1, 1) === 'в'){
        $gender++;
    }; 
    if (mb_substr($words['name'], -1, 1) === 'й' || mb_substr($words['name'], -1, 1) === 'н' || mb_substr($words['name'], -1, 1) === 'р'){
      $gender++;
    
    }; 
    if (mb_substr($words['patronymic'], -2, 2) === 'ич'){
       $gender++;
    };
   
        //женский пол
    if (mb_substr($words['surname'], -2, 2) === 'ва'){
       $gender--;
    };
   if (mb_substr($words['name'], -1, 1) === 'а' || mb_substr($words['name'], -1, 1) === 'я'){
        $gender--;
    } 
    if (mb_substr($words['patronymic'], -3, 3) === 'вна'){
       $gender--;
    }
    if($gender > 0){
        return 'определен мужской пол'; 
    } else if ($gender < 0){
        return 'определен женский пол'; 
    } else {
        return 'пол неопределен'; 
    }
};
// $fullname = 'Иванов Иван Иванович';
// echo getGenderFromName($fullname) . "\n";
// $fullname = 'Иванова Ольга Ивановна';
// echo getGenderFromName($fullname) . "\n";
// $fullname = 'Иван Ольи Иванови';
// echo getGenderFromName($fullname);

// Задание #5
// Определение пола

function getGenderDescription($example_persons_array){
    $count = count($example_persons_array); 
    $maleCount = 0;
    $femaleCount = 0;
    $undefinedCount = 0; 
    
    foreach($example_persons_array as $person){
        $gender = getGenderFromName($person['fullname']);// 
        if($gender === 'определен мужской пол'){
            $maleCount++;
        } else if ($gender === 'определен женский пол'){
            $femaleCount++;
        } else {
            $undefinedCount++;
        }
    }

    // Получение в процентах

    $totalMale = round(($maleCount / $count) * 100, 1); 
    $totalFemale = round(($femaleCount / $count) * 100, 1);
    $totalUndefined = round(($undefinedCount / $count) * 100, 1);
    
    $result = "Гендерный состав аудитории:\n";
    $result .= "---------------------------\n";
    $result .= "Мужчины - $totalMale%\n";
    $result .= "Женщины - $totalFemale%\n";
    $result .= "Не удалось определить - $totalUndefined%\n";

    return $result;
};
//print getGenderDescription($example_persons_array);
