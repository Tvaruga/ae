<?
$aMenuLinksExt = Array(
    Array(
        "Профиль",
        "/community/experts/".$_REQUEST['EXPERT_ID']."/",
        Array(),
        Array(),
        ""
    ),
	/*Array(
        "Блоги",
        "/community/experts/".$_REQUEST['EXPERT_ID']."/blogs/",
        Array(),
        Array(),
        "CSite::InGroup(array(1,14))"
    ),
    Array(
        "Ответы",
        "/community/experts/".$_REQUEST['EXPERT_ID']."/answers/",
        Array(),
        Array(),
        "CSite::InGroup(array(1,14))"
)*/
);


$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);