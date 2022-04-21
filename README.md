# Google Drive Test Task

1. Clone this repository
2. Copy .env.example to .env
3. Create database and add database name username and password into .env file
4. Run php artisan queue:table
5. Run php artisan migrate
6. Choose queue connection database on .env file
7. You need to use google oauthplaground to generate oauth token https://i.imgur.com/nfT1pQ2.png
8. Access token and refresh token you must pu on .env file (Access token is valid 4000 sec, you will see that on googleplayground console)
9. You need to click to Save files button, after that it will create a job in database
10. Then you need to run php artisan queue:work
11. Then from google drive it will download files and save in storage (google-drive folder)
