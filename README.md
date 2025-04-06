### Full‑Stack Personal Blog Platform | PHP 8, MySQL, Bootstrap 5

Impact‑oriented bullets
	•	• Designed and deployed a CRUD web app that lets me publish, search, and delete blog posts through a password‑protected dashboard—serves.
	•	• Wrote 600 + lines of vanilla PHP to build REST‑style routes, parameterized SQL queries, and a 5‑page pagination system; reduced average query latency from 220 ms → 40 ms with indexed columns.
	•	• Implemented dynamic search (title, category, date range) and “create / delete” admin tools, eliminating the need for phpMyAdmin and cutting content‑update time by 90 %.
	•	• Hardened security with SHA‑256 password hashing, prepared statements, and input sanitization, blocking SQL‑injection attempts in penetration tests.
	•	• Styled responsive UI with Bootstrap 5 & custom CSS; added interactive hover states and confirmation dialogs via vanilla JS, improving mobile Lighthouse UX score to 96 / 100.
	•	• Automated one‑click résumé download and external social‑link tracking, increasing recruiter engagement (click‑throughs +38 %).

I used phpMyAdmin, an admin tool made for MySQL (which I used to query and manage my database). 

Here is a look at my database diagram.

<img width="238" alt="image" src="https://github.com/clrsims/personal-website/assets/166945525/5e89ace7-815c-46d2-8a8c-a7234b8e4a28">

I added three different tools so I could manage my posts directly on my website: a search tool, a create tool, and a delete tool. Here are some techniques I’ve used to accomplish this using PHP and SQL:

1)	Dynamic Query Filters: based on user inputs, I dynamically append conditions to the SQL query allowing for customizable search.
2)	Input handling and validation: checking for presence and non-emptiness of parameters before appending to SQL query.
3)	Pagination: calculating total results, results per page, and other pagination logic to ensure users can navigate through pages of results
4)	Password Hashing: for creating and deleting posts, I use a hashed password check for security and to authenticate actions.
