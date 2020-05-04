<?php
    require_once('db.php');

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'autoscolder';

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);

    $persons = $db->query('SELECT * FROM person')->fetchAll();

?>
<html>
	<head>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.modal.min.js"></script>
        <link rel="stylesheet" href="css/jquery.modal.min.css" />
        <link rel="stylesheet" href="css/style.css" />

	</head>
	<body>
    <script type="text/javascript">
        var GENDER_FILTER = 2;
        var MONASTIC_FILTER = 2;
        var AGE_FILTER = 2;
        var CURRENT_PERSON = "";
        var nameAudio = "";
        var commandAudio = "";
    </script>
        <div class="filters">
            <ul class="genderFilter">
                <li class="malefemale"><a href="#" onClick="filterGender();"><img src="img/malefemale.png"/></a></li>
                <li class="female"><a href="#" onClick="filterGender();"><img src="img/female.png"/></a></li>
                <li class="male"><a href="#"  onClick="filterGender();"><img src="img/male.png"/></a></li>
            </ul>
            <ul class="monasticFilter">
                <li class="laymonastic"><a href="#" onClick="filterMonastic();"><img src="img/laymonastic.png"/></a></li>
                <li class="monastic"><a href="#" onClick="filterMonastic();"><img src="img/monastic.png"/></a></li>
                <li class="lay"><a href="#" onClick="filterMonastic();"><img src="img/lay.png"/></a></li>
            </ul>
            <ul class="ageFilter">
                <li class="kidadult"><a href="#" onClick="filterAge();"><img src="img/kidadult.png"/></a></li>
                <li class="adult"><a href="#" onClick="filterAge();"><img src="img/adult.png"/></a></li>
                <li class="kid"><a href="#" onClick="filterAge();"><img src="img/kid.png"/></a></li>
            </ul>
        </div>
		<ul class="faceGrid">
            <?php foreach ($persons as $person): ?>
                <li class="face <?php echo ($person['monastic']==1) ? 'monastic' : 'lay' ; ?> <?php echo ($person['age']==1) ? 'adult' : 'kid' ; ?> <?php echo ($person['gender']==1) ? 'female' : 'male' ; ?>"  namecode="<?php echo $person['namecode']; ?>" /> 
                    <a class="modalLink" href="#action_modal" onClick="updateModal('<?php echo $person['namecode']; ?>');">
                        <img src="faces/<?php echo $person['namecode']; ?>.jpg" />
                    </a>
                 </li>
            <?php endforeach; ?>
            <!--<li namecode="pende" gender="m" type="mon" age="adult">-->
                <!--<a href=""><img width="100" src="faces/pende.jpg"/></a>-->
            <!--</li>-->

        </ul>

<!--    <a href="#abcdef" onclick="setCurrentPerson('pechi');">-->
<!--        OKOKOKK-->
<!--    </a>-->
<!--    <div id="abcdef" class="modal">-->
<!--        <img src="faces/pende.jpg">-->
<!--    </div>-->

        <div id="action_modal" class="modal">
            <img class="modalFace" src="faces/<?php echo $person['namecode']; ?>.jpg" />
            <ul class="actions">
                <li>
                    <a href="#" onClick="javascript:launchSequence('action1');"><img src="img/action1.jpg" ?></a>
                </li>
                <li>
                    <a href="#" onClick="javascript:launchSequence('action2');"><img src="img/action2.jpg" ?></a>
                </li>
                <li>
                    <a href="#" onClick="javascript:launchSequence('action3');"><img src="img/action3.jpg" ?></a>
                </li>
                <li>
                    <a href="#" onClick="javascript:launchSequence('action4');"><img src="img/action4.jpg" ?></a>
                </li>
            </ul>
        </div>





    </body>
    <script type="text/javascript">

        jQuery( document ).ready(function() {


            jQuery('.modalLink').each(function() {
                jQuery(this).click(function(event) {
                    event.preventDefault();
                    jQuery(this).modal({
                        fadeDuration: 300
                    });
                });
            });


        });


    function filterFaces() {
        jQuery('.faceGrid .face').each(function() {
            jQuery(this).show();
        });

        var hideClasses = new Array();

        if(GENDER_FILTER !== 2) {
            if(GENDER_FILTER==1) {
                hideClasses.push('male');
            } else if(GENDER_FILTER==0) {
                hideClasses.push('female');
            }
        }
        if(AGE_FILTER !== 2) {
            if(AGE_FILTER==1) {
                hideClasses.push('kid');
            } else if(AGE_FILTER==0) {
                hideClasses.push('adult');
            }
        }
        if(MONASTIC_FILTER !== 2) {
            if(MONASTIC_FILTER==1) {
                hideClasses.push('lay');
            } else if(MONASTIC_FILTER==0) {
                hideClasses.push('monastic');
            }
        }

        hideClasses.forEach(function(reqClass) {
            jQuery('.faceGrid .face').each(function() {
                if(jQuery(this).hasClass(reqClass)) {
                    jQuery(this).hide();
                }
            });
        });

    }

    function filterGender() {
        switch (GENDER_FILTER) {
            case 0 :
                jQuery('.genderFilter .malefemale').show();
                jQuery('.genderFilter .male').hide();
                jQuery('.genderFilter .female').hide();
                GENDER_FILTER = 2;
                break;
            case 1 :
                jQuery('.genderFilter .malefemale').hide();
                jQuery('.genderFilter .male').show();
                jQuery('.genderFilter .female').hide();
                GENDER_FILTER = 0;
                break;
            case 2 :
                jQuery('.genderFilter .malefemale').hide();
                jQuery('.genderFilter .male').hide();
                jQuery('.genderFilter .female').show();
                GENDER_FILTER = 1;
                break;
        }
        filterFaces();
    }

    function filterAge() {
        switch (AGE_FILTER) {
            case 0 :
                jQuery('.ageFilter .kidadult').show();
                jQuery('.ageFilter .kid').hide();
                jQuery('.ageFilter .adult').hide();
                AGE_FILTER = 2;
                break;
            case 1 :
                jQuery('.ageFilter .kidadult').hide();
                jQuery('.ageFilter .kid').show();
                jQuery('.ageFilter .adult').hide();
                AGE_FILTER = 0;
                break;
            case 2 :
                jQuery('.ageFilter .kidadult').hide();
                jQuery('.ageFilter .kid').hide();
                jQuery('.ageFilter .adult').show();
                AGE_FILTER = 1;
                break;
        }
        filterFaces();
    }

    function filterMonastic() {
        switch (MONASTIC_FILTER) {
            case 0 :
                jQuery('.monasticFilter .laymonastic').show();
                jQuery('.monasticFilter .lay').hide();
                jQuery('.monasticFilter .monastic').hide();
                MONASTIC_FILTER = 2;
                break;
            case 1 :
                jQuery('.monasticFilter .laymonastic').hide();
                jQuery('.monasticFilter .lay').show();
                jQuery('.monasticFilter .monastic').hide();
                MONASTIC_FILTER = 0;
                break;
            case 2 :
                jQuery('.monasticFilter .laymonastic').hide();
                jQuery('.monasticFilter .lay').hide();
                jQuery('.monasticFilter .monastic').show();
                MONASTIC_FILTER = 1;
                break;
        }
        filterFaces();
    }

    function setCurrentPerson(namecode) {
        CURRENT_PERSON = namecode;
    }

    function updateModal(namecode) {
        jQuery('.modalFace').attr('src','faces/'+namecode+'.jpg');
        setCurrentPerson(namecode);
    }

    function launchSequence(command) {
        nameAudio = new Audio('sound/name/' + CURRENT_PERSON +'.mp3');
        commandAudio = new Audio('sound/command/' + command +'.mp3');

        nameAudio.addEventListener('ended', function(){
            commandAudio.play();
        });
        nameAudio.play();
    }
    </script>
</html>