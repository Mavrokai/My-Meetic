<div id="top">

<!-- HEADER STYLE: CLASSIC -->
<div align="center">


# MY-MEETIC

<em>Connect, Engage, and Discover Meaningful Relationships Today</em>

<!-- BADGES -->
<img src="https://img.shields.io/github/last-commit/Mavrokai/My-Meetic?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
<img src="https://img.shields.io/github/languages/top/Mavrokai/My-Meetic?style=flat&color=0080ff" alt="repo-top-language">
<img src="https://img.shields.io/github/languages/count/Mavrokai/My-Meetic?style=flat&color=0080ff" alt="repo-language-count">

<em>Built with the tools and technologies:</em>

<img src="https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=flat&logo=JavaScript&logoColor=black" alt="JavaScript">
<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">

</div>
<br>

---

## Table of Contents

- [Overview](#overview)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Testing](#testing)
- [Project Structure](#project-structure)
    - [Project Index](#project-index)

---

## Overview

My-Meetic is a powerful developer tool designed to streamline the creation of a robust dating application, focusing on user engagement and seamless data management.

**Why My-Meetic?**

This project empowers developers to build dynamic dating platforms efficiently. The core features include:

- **🔗 Database Connection:** Ensures robust error handling and seamless data interactions.
- **📊 Database Schema Initialization:** Simplifies setup with pre-configured data for quick deployment.
- **👤 User Profile Management:** Allows easy updates and management of personal information, enhancing user engagement.
- **🔍 Dynamic Search Interface:** Provides an intuitive way for users to find matches based on customizable criteria.
- **🔒 User Authentication:** Ensures secure registration and login processes, addressing security concerns.
- **🎨 Responsive Design:** Enhances user interaction with dynamic elements, making the application more engaging.

---

## Project Structure

```sh
└── My-Meetic/
    ├── MVC
    │   ├── Controller
    │   ├── model
    │   └── vue
    ├── Meetic.sql
    ├── config.php
    └── public
        ├── JS
        └── assets
```

---

### Project Index

<details open>
	<summary><b><code>MY-MEETIC/</code></b></summary>
	<!-- __root__ Submodule -->
	<details>
		<summary><b>__root__</b></summary>
		<blockquote>
			<div class='directory-path' style='padding: 8px 0; color: #666;'>
				<code><b>⦿ __root__</b></code>
			<table style='width: 100%; border-collapse: collapse;'>
			<thead>
				<tr style='background-color: #f8f9fa;'>
					<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
					<th style='text-align: left; padding: 8px;'>Summary</th>
				</tr>
			</thead>
				<tr style='border-bottom: 1px solid #eee;'>
					<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/config.php'>config.php</a></b></td>
					<td style='padding: 8px;'>- Establishes a connection to the MySQL database for the Meetic project, ensuring robust error handling and reporting<br>- By configuring essential parameters such as host, database name, username, and password, it facilitates seamless data interactions throughout the application<br>- This foundational setup is crucial for enabling other components of the codebase to perform database operations effectively and reliably.</td>
				</tr>
				<tr style='border-bottom: 1px solid #eee;'>
					<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/Meetic.sql'>Meetic.sql</a></b></td>
					<td style='padding: 8px;'>- Meetic.sql-Project SummaryThe <code>Meetic.sql</code> file serves as a foundational component of the project, encapsulating the database schema and initial data necessary for the application to function effectively<br>- This SQL dump is generated from phpMyAdmin and is designed to facilitate the setup of the project's database environment, ensuring that all required tables, relationships, and data entries are established.By providing a structured representation of the database, <code>Meetic.sql</code> enables developers and users to quickly deploy the application with a pre-configured database, streamlining the onboarding process and enhancing productivity<br>- This file is crucial for maintaining data integrity and consistency across different environments, allowing for seamless development, testing, and production workflows.In summary, <code>Meetic.sql</code> is essential for initializing the database layer of the project, supporting the overall architecture by ensuring that the application has access to the necessary data structures from the outset.</td>
				</tr>
			</table>
		</blockquote>
	</details>
	<!-- MVC Submodule -->
	<details>
		<summary><b>MVC</b></summary>
		<blockquote>
			<div class='directory-path' style='padding: 8px 0; color: #666;'>
				<code><b>⦿ MVC</b></code>
			<!-- vue Submodule -->
			<details>
				<summary><b>vue</b></summary>
				<blockquote>
					<div class='directory-path' style='padding: 8px 0; color: #666;'>
						<code><b>⦿ MVC.vue</b></code>
					<table style='width: 100%; border-collapse: collapse;'>
					<thead>
						<tr style='background-color: #f8f9fa;'>
							<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
							<th style='text-align: left; padding: 8px;'>Summary</th>
						</tr>
					</thead>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/vue/acceuil.php'>acceuil.php</a></b></td>
							<td style='padding: 8px;'>- Provides the main landing page for the Meetic application, welcoming users and guiding them through the platforms features<br>- It integrates navigation elements for user authentication and profile management, while showcasing the unique offerings of the service, such as personalized profiles and intelligent search capabilities<br>- This page serves as a crucial entry point, enhancing user engagement and facilitating access to the applications functionalities.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/vue/profile.php'>profile.php</a></b></td>
							<td style='padding: 8px;'>- Facilitates user profile management within the Meetic application by displaying personalized profile information and allowing users to update their details, manage hobbies, and handle profile photos<br>- It integrates navigation elements for seamless user experience and ensures data security through proper handling of user inputs<br>- This component plays a crucial role in enhancing user engagement and satisfaction within the overall application architecture.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/vue/recherche.php'>recherche.php</a></b></td>
							<td style='padding: 8px;'>- Facilitates user interaction within the Meetic platform by providing a dynamic search interface for finding potential matches based on customizable criteria such as gender, location, hobbies, and age range<br>- It enhances user experience through an intuitive design and responsive layout, while integrating essential features like personalized profiles and security measures, ultimately promoting a safe and engaging dating environment.</td>
						</tr>
					</table>
					<!-- Auth Submodule -->
					<details>
						<summary><b>Auth</b></summary>
						<blockquote>
							<div class='directory-path' style='padding: 8px 0; color: #666;'>
								<code><b>⦿ MVC.vue.Auth</b></code>
							<table style='width: 100%; border-collapse: collapse;'>
							<thead>
								<tr style='background-color: #f8f9fa;'>
									<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
									<th style='text-align: left; padding: 8px;'>Summary</th>
								</tr>
							</thead>
								<tr style='border-bottom: 1px solid #eee;'>
									<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/vue/Auth/register.php'>register.php</a></b></td>
									<td style='padding: 8px;'>- Facilitates user registration for the Meetic platform by providing a structured form that collects essential personal information, including name, date of birth, gender, city, email, password, hobbies, and profile photo<br>- It ensures data validation and error handling while integrating with the AuthController for processing submissions<br>- This component plays a crucial role in the overall architecture by enabling new user onboarding and enhancing user engagement.</td>
								</tr>
								<tr style='border-bottom: 1px solid #eee;'>
									<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/vue/Auth/login.php'>login.php</a></b></td>
									<td style='padding: 8px;'>- Facilitates user authentication within the My Meetic application by providing a login interface<br>- It allows users to enter their email and password, submitting the information to the LoginController for processing<br>- The design is user-friendly, featuring error message handling and a link for new users to register, ensuring a seamless experience in accessing the platforms features.</td>
								</tr>
							</table>
						</blockquote>
					</details>
				</blockquote>
			</details>
			<!-- Controller Submodule -->
			<details>
				<summary><b>Controller</b></summary>
				<blockquote>
					<div class='directory-path' style='padding: 8px 0; color: #666;'>
						<code><b>⦿ MVC.Controller</b></code>
					<table style='width: 100%; border-collapse: collapse;'>
					<thead>
						<tr style='background-color: #f8f9fa;'>
							<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
							<th style='text-align: left; padding: 8px;'>Summary</th>
						</tr>
					</thead>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/ProfilController.php'>ProfilController.php</a></b></td>
							<td style='padding: 8px;'>- ProfilController orchestrates user profile management within the application, enabling functionalities such as updating personal information, changing passwords, and managing hobbies and photos<br>- It ensures secure session handling and provides feedback on user actions, enhancing the overall user experience<br>- By integrating with the ProfileModel, it facilitates seamless interaction with user data, contributing to a cohesive architecture that prioritizes user engagement and data integrity.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/AuthController.php'>AuthController.php</a></b></td>
							<td style='padding: 8px;'>- AuthController facilitates user registration within the MVC architecture by handling form submissions and validating input<br>- It provides options for users to select hobbies and verifies the legitimacy of French city names through an external API<br>- Upon successful registration, it returns a JSON response indicating success or error messages, ensuring a smooth user experience while managing potential database issues effectively.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/LoginController.php'>LoginController.php</a></b></td>
							<td style='padding: 8px;'>- Handles user login functionality within the MVC architecture by processing POST requests for authentication<br>- It validates user input, checks credentials against the database, and manages session initiation upon successful login<br>- Additionally, it provides appropriate HTTP responses for various scenarios, such as missing fields, inactive accounts, and incorrect credentials, ensuring a secure and user-friendly authentication experience.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/RechercheController.php'>RechercheController.php</a></b></td>
							<td style='padding: 8px;'>- Facilitates user interaction by managing search functionalities within the application<br>- It ensures that only authenticated users can access search features, allowing them to filter and display user profiles based on various criteria such as gender, city, age, and hobbies<br>- Additionally, it provides feedback through flash messages and handles the presentation of search results, enhancing the overall user experience in the platform.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/AcceuilController.php'>AcceuilController.php</a></b></td>
							<td style='padding: 8px;'>- Manages user session validation and redirection within the MVC architecture<br>- It ensures that users are authenticated before accessing certain functionalities, providing feedback through flash messages for session expirations<br>- The controller facilitates navigation by redirecting users to the login page when necessary, thereby enhancing the overall user experience and maintaining secure access to the application.</td>
						</tr>
					</table>
					<!-- Auth Submodule -->
					<details>
						<summary><b>Auth</b></summary>
						<blockquote>
							<div class='directory-path' style='padding: 8px 0; color: #666;'>
								<code><b>⦿ MVC.Controller.Auth</b></code>
							<table style='width: 100%; border-collapse: collapse;'>
							<thead>
								<tr style='background-color: #f8f9fa;'>
									<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
									<th style='text-align: left; padding: 8px;'>Summary</th>
								</tr>
							</thead>
								<tr style='border-bottom: 1px solid #eee;'>
									<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/Controller/Auth/logout.php'>logout.php</a></b></td>
									<td style='padding: 8px;'>- Facilitates user logout by terminating the current session, clearing session variables, and redirecting to the login page<br>- This functionality is essential for maintaining user security and session management within the MVC architecture, ensuring that users can safely exit their accounts and preventing unauthorized access to their information.</td>
								</tr>
							</table>
						</blockquote>
					</details>
				</blockquote>
			</details>
			<!-- model Submodule -->
			<details>
				<summary><b>model</b></summary>
				<blockquote>
					<div class='directory-path' style='padding: 8px 0; color: #666;'>
						<code><b>⦿ MVC.model</b></code>
					<table style='width: 100%; border-collapse: collapse;'>
					<thead>
						<tr style='background-color: #f8f9fa;'>
							<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
							<th style='text-align: left; padding: 8px;'>Summary</th>
						</tr>
					</thead>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/model/ProfileModel.php'>ProfileModel.php</a></b></td>
							<td style='padding: 8px;'>- ProfileModel.php serves as a crucial component of the MVC architecture, managing user-related data and interactions within the application<br>- It facilitates user data retrieval, updates, and hobby management, ensuring a seamless experience for users to manage their profiles<br>- Additionally, it handles account deactivation and photo management, contributing to a comprehensive user profile management system that enhances user engagement and personalization.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/model/RechercheModel.php'>RechercheModel.php</a></b></td>
							<td style='padding: 8px;'>- Provides functionality for retrieving hobbies and filtering users based on various criteria such as gender, city, age, and hobbies<br>- It interacts with the database to fetch relevant user data while ensuring active users are prioritized<br>- This model serves as a crucial component in the MVC architecture, facilitating data management and enhancing user experience within the application.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/model/LoginModel.php'>LoginModel.php</a></b></td>
							<td style='padding: 8px;'>- Facilitates user authentication by verifying login credentials against stored user data<br>- It checks the users email and password, ensuring the account is active before granting access<br>- This functionality is crucial for maintaining secure access to the application, integrating seamlessly within the MVC architecture to manage user sessions and protect sensitive information throughout the codebase.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/MVC/model/RegisterModel.php'>RegisterModel.php</a></b></td>
							<td style='padding: 8px;'>- Facilitates user registration by processing input data, storing user information in a database, and managing profile photo uploads<br>- It retrieves available hobbies for user selection and associates selected hobbies with the newly registered user<br>- The architecture ensures data integrity through transaction management, handling errors gracefully while maintaining a structured approach to user profile creation within the broader MVC framework.</td>
						</tr>
					</table>
				</blockquote>
			</details>
		</blockquote>
	</details>
	<!-- public Submodule -->
	<details>
		<summary><b>public</b></summary>
		<blockquote>
			<div class='directory-path' style='padding: 8px 0; color: #666;'>
				<code><b>⦿ public</b></code>
			<!-- JS Submodule -->
			<details>
				<summary><b>JS</b></summary>
				<blockquote>
					<div class='directory-path' style='padding: 8px 0; color: #666;'>
						<code><b>⦿ public.JS</b></code>
					<table style='width: 100%; border-collapse: collapse;'>
					<thead>
						<tr style='background-color: #f8f9fa;'>
							<th style='width: 30%; text-align: left; padding: 8px;'>File Name</th>
							<th style='text-align: left; padding: 8px;'>Summary</th>
						</tr>
					</thead>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/public/JS/home.js'>home.js</a></b></td>
							<td style='padding: 8px;'>- Enhances user interaction by implementing a dropdown navigation feature within the web application<br>- Upon loading the document, it sets up an event listener that toggles the visibility of a search dropdown when the corresponding button is clicked<br>- This functionality contributes to a more dynamic and user-friendly interface, aligning with the overall goal of improving navigation and accessibility within the project.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/public/JS/Login.js'>Login.js</a></b></td>
							<td style='padding: 8px;'>- Handles user login functionality by capturing form submissions, preventing default behavior, and sending the data to the server asynchronously<br>- It processes the servers response to either redirect the user upon successful login or display an error message if the login fails<br>- This component plays a crucial role in enhancing user experience by providing immediate feedback during the authentication process within the overall application architecture.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/public/JS/Register.js'>Register.js</a></b></td>
							<td style='padding: 8px;'>- Facilitates user registration by validating input fields, including names, birthdate, hobbies, city, and password confirmation<br>- It enhances user experience through real-time city suggestions and error handling, ensuring all required information is correctly submitted<br>- The registration process is streamlined with asynchronous form submission, providing feedback on success or errors, thereby contributing to a robust user onboarding experience within the overall application architecture.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/public/JS/recherche.js'>recherche.js</a></b></td>
							<td style='padding: 8px;'>- Enhances user interaction by implementing dynamic dropdown navigation and a responsive photo carousel within the web application<br>- It facilitates profile browsing through swipe gestures and button clicks, allowing users to like or dislike profiles seamlessly<br>- This functionality enriches the overall user experience, making the interface more engaging and intuitive while maintaining a cohesive design across the project.</td>
						</tr>
						<tr style='border-bottom: 1px solid #eee;'>
							<td style='padding: 8px;'><b><a href='https://github.com/Mavrokai/My-Meetic/blob/master/public/JS/profile.js'>profile.js</a></b></td>
							<td style='padding: 8px;'>- Enhances user interaction on the profile page by managing email input validation, hobby selection, and photo uploads<br>- It provides real-time feedback for errors, allows users to add and remove hobbies dynamically, and facilitates image previews with deletion options<br>- Additionally, it incorporates a dropdown navigation feature, contributing to a seamless and engaging user experience within the overall application architecture.</td>
						</tr>
					</table>
				</blockquote>
			</details>
		</blockquote>
	</details>
</details>

---

## Getting Started

### Prerequisites

This project requires the following dependencies:

- **Programming Language:** PHP
- **Package Manager:** Composer

### Installation

Build My-Meetic from the source and intsall dependencies:

1. **Clone the repository:**

    ```sh
    ❯ git clone https://github.com/Mavrokai/My-Meetic
    ```

2. **Navigate to the project directory:**

    ```sh
    ❯ cd My-Meetic
    ```

3. **Install the dependencies:**

**Using [composer](https://www.php.net/):**

```sh
❯ composer install
```

### Usage

Run the project with:

**Using [composer](https://www.php.net/):**

```sh
php {entrypoint}
```

### Testing

My-meetic uses the {__test_framework__} test framework. Run the test suite with:

**Using [composer](https://www.php.net/):**

```sh
vendor/bin/phpunit
```

---

<div align="left"><a href="#top">⬆ Return</a></div>

---
