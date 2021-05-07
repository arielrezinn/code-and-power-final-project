<?php
include "../reused-components/constants.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reflection - Charles Houghtaling</title>
    </head>
    <body class="pg-reflections">
        <?php include "../reused-components/navbar.php"; ?>
        <h1>Reflection - Charles Houghtaling</h1>
        <div class="container">
            <p>
                I decided to take this course because it covered material that none of my other computer science courses here at the University of Wisconsin-Madison have taught me and because I was interested in expanding my web development knowledge, specifically wanting to learn more about PHP and SQL. Now that we have reached the end of the semester, I am so glad to have enrolled in this course. In addition to enjoying our various discussions and projects, I have learned so many things that I will be able to apply as I work in various roles throughout the technology industry. I think the content that we discussed throughout this entire course is something that everyone should be very mindful of when developing in order to make their overall products as inclusive and accessible as possible. I really enjoyed reading Noble’s Algorithms of Oppression and watching the Coded Bias documentary to see how technology can impact people in very different ways and the consequences that are associated with these disparities. Not only has this course allowed me to learn new skills and technologies for my future career, but it has also had a direct impact on other computer science courses I have taken this semester. I had never used PHP prior to this semester, but I was easily able to transfer and apply the skills I have learned in this course back and forth with the things I learned in the software engineering course I was also taking this semester. This helped out a lot when it came to developing our group’s final project since I had become extremely familiar with using HTML, CSS, PHP, and SQL as a result of continually transferring my knowledge between these two courses over the past 15 weeks. 
            </p>
            <p>
                When it came time to work on the group project, one of my main roles was developing the backend and laying the foundation for our project since I was the team member that was most familiar with PHP and SQL as a result of using these technologies for many projects throughout the semester. I set up and managed the database, linked files together, and created skeleton PHP pages that used a variety of variables to display content on the screen. The structure of our code ended up working out extremely well for our project since we are able to easily update the majority of the text that appears throughout our project by simply editing one file and having it automatically update across any page where that variable is referenced. In terms of design, I worked with Ariel in creating an accessible color scheme for our project, and I also did various design refinements to the CSS styling that Michael had created. I also did multiple refactors across various pages of our project to make the code streamlined and easier to maintain, with the largest of them being on the results page. I also did a major refactor on our questions pages and condensed them all into one file by storing all of the questions in an array and using the $_GET super global variable to determine which index of the array to pull the question from based off of the URL of the page the user is on while taking the survey. This made everything so much easier to maintain because if we wanted to update the design or information that appeared on our question pages, we could easily update one file rather than having to go in and make the same edit 25 times across all of the question files. Non-development wise, I also wrote a few questions for our survey and organized group meetings.
            </p>
            <p>
                Overall, I think the project and the remote paired programming sessions went really well! I thought it was really fun getting to know everyone while we developed the project. Everyone did a great job at communicating with one another through our iMessage group chat, and our group meetings were also extremely helpful with pair programming since we were able to easily ask one another for assistance or opinions on how something should be implemented. We held Zoom meetings on a regular basis throughout each iteration of the assignment, which provided a great way to ensure that everyone was on the same page and not accidentally overwriting someone else’s work. If I could change anything about the way we implemented this project, I would have had us utilize GitHub to make collaboration even easier and more efficient, but overall I think we still did an amazing job with the workflow that we used. Each team member was extremely helpful and involved throughout every step of the project, from writing questions all the way through putting in some final touches and writing the group and individual reflections. I think that our project turned out really well and I hope that it has an impact in drawing people’s attention towards improving accessibility.
            </p>
            <p>
                It’s been such a fun semester!
            </p>
        </div>
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>