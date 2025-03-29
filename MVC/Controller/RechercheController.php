<?php
session_start();

include_once __DIR__ . '../../model/RechercheModel.php';

if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Session expirée, veuillez vous reconnecter');
    redirect('../vue/Auth/login.php');
    exit;
}


function displayHobbiesOptions()
{
    $hobbies = getHobbies();

    echo '<option value="">Sélectionnez un hobby</option>';
    foreach ($hobbies as $hobby) {
        echo '<option value="' . htmlspecialchars($hobby["id"]) . '">' . htmlspecialchars($hobby["name"]) . '</option>';
    }
}


function handleSearch()
{


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $users = getFilteredUsers([]);
        
        if (empty($users)) {
            setFlashMessage('info', 'Aucun profil disponible pour le moment');
        }
        displayResults($users ?? []);
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        $filters = [
            'gender' => $_POST['gender'] ?? '',
            'city' => trim($_POST['ville'] ?? ''),
            'age' => $_POST['age'] ?? '',
            'hobby' => $_POST['hobbies'] ?? []
        ];


        if ($filters['age'] === '45+') {
            $filters['age'] = '45/100';
        }

        $users = getFilteredUsers($filters);

        if (empty($users)) {
            setFlashMessage('info', 'Aucun résultat trouvé avec ces critères');
        }

        displayResults($users ?? []);
    }
}

function displayResults($users)
{



    if (empty($users)) {
        echo '<div class="no-results-container">';
        echo '<div class="no-results">';
        echo '<img src="../../public/assets/8b0a9a1393af871b28ce53b47b61919d.gif" alt="Aucun résultat">';
        echo '<p>Aucun profil trouvé</p>';
        echo '</div>';
        echo '</div>';
        return;
    }


    echo '<div class="profiles-container">';
    foreach ($users as $user) {


        $age = date_diff(date_create($user['birthday']), date_create('today'))->y;
        
        $photos = !empty($user['profile_photo']) ? explode(',', $user['profile_photo']) : [];

        echo '<div class="profile-card" data-user-id="' . $user['id'] . '">';
        echo '<div class="photos-container">';
        foreach ($photos as $index => $photo) {
            $active = $index === 0 ? 'active' : '';
            echo '<div class="photo ' . $active . '">';
            echo '<img src="/profile_photos/' . $user['id'] . '/' . htmlspecialchars($photo) . '">';
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="profile-info">';
        echo '<h3>' . htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) . '</h3>';
        echo '<div class="age-city">';
        echo '<span>' . $age . ' ans</span>';
        echo '<span>' . htmlspecialchars($user['city']) . '</span>';
        echo '</div>';
        echo '<p class="hobbies">' . htmlspecialchars($user['hobbies']) . '</p>';
        echo '</div>';

        echo '<div class="actions">';
        echo '<button class="dislike-btn">✖</button>';
        echo '<button class="like-btn">❤</button>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
}



function setFlashMessage($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function redirectBack()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
