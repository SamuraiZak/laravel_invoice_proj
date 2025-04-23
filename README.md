clone the project from GitHub,
put the .env file inside project directory (need mailer API key)


Run the following commands:

=================  Commands Section =================

npm install

composer install 
(if this takes forever, get windows defender to ignore this file. If you're using windows)

touch database/database.sqlite


php artisan migrate:refresh --seed


npm run build  
(else tailwindCSS assets dont get served)


php artisan serve
(click the link that appears in terminal)

=================  Commands Section End =================


====================================
2 users will constantly be seeded, username 'zaki' & 'haziq' both with passwords = 'password'
of course, you can try registering new user to try the app with empty data


**Important
when creating client in the site, make sure you input the email registered to MailGun (give me your email so I can add it to list of recipients)

**Sidenotes
dashboard have 3 buttons, client, project, outstanding invoices to list the respective data.
outstanding invoice only shows invoices that is marked as unpaid. When you mark them as paid, they will disappear from that page.

to generate invoice, you would have to go to the projects view page, and generate the invoice from there

emails are sent on invoice generation, 
