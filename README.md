# Tarheta

Tarheta is a powerful web application designed for both students and teachers to make learning more engaging and efficient. With Tarheta, users can create flashcards for quizzes, exams, and reviewers, allowing them to review and reinforce key concepts in an interactive and enjoyable way. For teachers, Tarheta also provides the option to create classes, enabling them to organize simultaneous tests and quiz-taking for their students. Additionally, the application offers several flashcard organization features and a real-time notification system, ensuring that users never miss an important update or deadline. Built using the CodeIgniter 3 framework and MySQL for the database, Tarheta is a robust and reliable tool for enhancing learning outcomes.

<img src="./assets/images/readme/homepage.png" height="300">

# Functionality

- **Flashcard System:** Questions are presented as flashcards.

    <img src="./assets/images/readme/answering-1.png" height="300">

    - Users can choose between different types of questions, time for each question and score.

        <img src="./assets/images/readme/create-flashcard-question-2.png" height="300">
        <img src="./assets/images/readme/create-flashcard-question-3.png" height="300">
    
    - After finishing answering the user can view their statistic.
    <img src="./assets/images/readme/answering-3.png" height="300">

- **Class System:** Teachers can create classes in order to group Students to easily assign flashcards.

    <img src="./assets/images/readme/view-class.png" height="300">

    - Teachers can invite Students directly via the user's email.

        <img src="./assets/images/readme/inviting-through-email.png" height="300">
    
    - Or Students can join via the given Class Code.

        <img src="./assets/images/readme/join-via-code.png" height="300">

- **Realtime Notifications:** Users are notified about events relating to their accounts.
    
    <img src="./assets/images/readme/notification-system-1.png" height="300">
    <img src="./assets/images/readme/notification-system-2.png" height="300">

- **Flashcard Organization:** Flashcards can be grouped and viewed via Subject, Visibility and Sets.

    <img src="./assets/images/readme/view-all-flashcards-2.png" height="300">

    - Users can create flashcard Sets to further group desired flashcards.
    <img src="./assets/images/readme/view-set-with-flashcards.png" height="300">

- **User Profile Personalization:** User can set relevant information in order to distinguish themselves.

    <img src="./assets/images/readme/profile.png" height="300">
    
# Requirements
- [XAMPP](https://www.apachefriends.org)
- [RCAPTCHA](https://www.google.com/recaptcha/about/) site key and secret key
- Email and it's password for the .env file

# Installation

1. Clone this repository.
2. Import the sql file from the schema folder.
3. Edit the **.env** file by providing the required details.
####
    EMAIL = ""
    EMAIL_PASSWORD = ""
    RCAPTCHA_SITE_KEY = ""
    RCAPTCHA_SECRET_KEY = ""

4. Edit the config.php  base_url with your desired localhost link.
#### Sample:
    $config['base_url'] = 'http://localhost/tarheta/';

5. Edit the database.php by placing the name of the XAMPP database.
#####
    'username' => 'root',
	'password' => '',
	'database' => 'databaseNameHere',
6. Run **XAMPP** control panel with **Apache** and **MySQL** services running.
7. Access the application with the link given in step number 4.