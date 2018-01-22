<?php
$model->idCardNumber = $generalInfo->id_card_number;
$model->familyName = $generalInfo->family_name;
$model->familyNameZh = $generalInfo->family_name_zh;
$model->givenName = $generalInfo->given_name;
$model->givenNameZh = $generalInfo->given_name_zh;
$model->gender = $generalInfo->gender;
$model->education = $generalInfo->education;
$model->mobilePhone = $generalInfo->mobile_phone;
$model->otherPhone = $generalInfo->other_phone;
$model->address = $generalInfo->address;

$model->englishName = $jobInfo->english_name;
$model->entryDate = $jobInfo->entry_date;
$model->department = $jobInfo->department;
$model->position = $jobInfo->position;
$model->email = $jobInfo->email;
$model->basicSalary = $jobInfo->basic_salary;
?>

<div class="update-staff col-sm-12">
    <?php
    echo $this->render('form', [
        'models' => $model,
        'scenario' => $scenario,
    ]);
    ?>
</div>
