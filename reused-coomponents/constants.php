<?php

// TITLE ENDINGS
$TITLE_ENDING = " | LIS 500 Group 1 Final";

// NAVBAR
$NAV_HOME = "Home";
$NAV_SURVEY = "Survey";
$NAV_RESULTS = "Results";
$NAV_RESOURCES = "Resources";
$NAV_ANALYSIS = "Group Analysis";
$NAV_REFLECTIONS = "Individual Reflections";

//FOOTER
$A11Y_STATEMENT = "We made every effort to make this site accessible and adhere to WCAG AA standards. That said, we're still learning! If you find anything that needs correction and/or isn't accessible, please reach out to arezin(at)wisc.edu";
$TAKE_BACK_TO_RAROYSTON_FINAL_PROJECT = "take me to all LIS 500 final projects";
$FOOT_COPYRIGHT = "&copy; " . date("Y") . " LIS 500 Group 1";

// HOMEPAGE CONSTANTS
$TITLE_HOMEPAGE = "LIS 500 Group 1 Final";
$HOMEPAGE_TITLE = "How aware are you of everyday ableism?";
$HOMEPAGE_BUTTON_GOTO = "Go to Survey";
$HOMEPAGE_WELCOME = "Welcome to our final project for the Spring 2021 semester of LIS 500: Code and Power at the University of Wisconsin-Madison. Click the \"" . $HOMEPAGE_BUTTON_GOTO . "\" button below to begin the survey, or keep reading to learn more.";
$HOMEPAGE_INFO = "Our assignment was to create a survey that encourages participants to think critically about their experiences as they relate to a marginalized group of people. After much discussion, our group decided to focus on the survey participants' awareness of the ableism that occurs in everyday life."; 
$HOMEPAGE_AUDIENCE = "The majority of our survey participants will likely be our fellow LIS 500 classmates, many of whom will be entering the field of software development. Our hope is that this survey has a lasting impact on its participants and inspires them to advocate for accessibility in the software they contribute to in the future.";


// SURVEY INSTRUCTIONS
$TITLE_SURVEY_INSTRUCTIONS_PAGE = "Instructions" . $TITLE_ENDING;
$SURVEY_TITLE = "Survey Instructions";
$SURVEY_GENERAL_INFO = "You will be shown a series of statements and will be asked to rate how often you observe or experience each statement. You will see your results upon survey completion, as well as the average results of all other survey participants. Our team intentionally did not include \"neutral\" response options in our survey so that survey takers must confront these tough questions honestly. However, you are free to exit the survey at any time by either closing the tab or using the navigation bar to visit another page.";
$SURVEY_DURATION_INFO = "This survey should take around 10 minutes to complete. Our team made the intentional decision to not track survey duration, but we encourage you to answer each question as quickly and accurately as you are able to.";
$SURVEY_TIME_INFO = "Comparing an individual's survey duration with that of other participants does not support nor enhance that individual's understanding of ableism as it relates to their own life. Therefore we are not measuring the time it takes to answer questions as time is an inaccurate metric that can be impacted by a participant's mood, cognition, environment, ability, and more. We thank you for your understanding.";
$SURVEY_BUTTON_BEGIN = "Begin Survey";

// QUESTION CONSTANTS
$Q_BUTTON_CONTINUE = "Continue";
$TITLE_QUESTION_FIRST_HALF = "Question ";
$TITLE_QUESTION_SECOND_HALF = $TITLE_ENDING;

// QUESTION OPTIONS
$Q_OPT_5 = "Very Often";
$Q_OPT_4 = "Often";
$Q_OPT_3 = "Somewhat Often";
$Q_OPT_2 = "Rarely";
$Q_OPT_1 = "Never";

// QUESTIONS
$QUESTIONS = [
    "How often do you think of disabled people as inspiring?",
    "How often do you consider whether the places you visit are wheelchair accessible at the primary entrance?",
    // "How often have you heard about the Americans with Disabilities Act (ADA)?", // TODO maybe rephrase or delete this question
    "How often do you feel uncomfortable when interacting with those with a disability?",
    "How often do you see people using mobility aids (wheelchairs, canes, walkers, service dogs, etc.) in the media?",
    "How often do you see blind and low vision people in the media?",
    "How often do you see hard of hearing or d/Deaf people in the media?",
    "How often do you see neurodivergent people (Austistics, ADHDers, etc.) represented in the media?",
    "How often do you see people who use augmentative or alternative communication devices (i.e. word boards, tablets, iPads) represented in the media?",
    "How often do you think the websites and applications you use regularly are accessible?", // TODO maybe rephrase or delete this question
    "How often do you judge someone who has difficulty with verbal communication?",
    "How often have you judged someone for parking in an accessible parking stall if they don’t “look disabled”?", 
    "How often do strangers ask you about your medical history?",
    "How often have you been asked to speak for/represent all people of your same ability?",
    "How often do you add image descriptions when you share images on social media?",
    "How often do you benefit from videos being captioned?",
    "How often do you see people who look like you in the media?",
    "How often have you been told how to request accommodations when applying for jobs?",
    "How often do you lift up disabled voices?",
    "How often do you discuss disability and accessibility with those around you?",
    "How often do you seek out disability advocates to learn from?",
    "How often have you struggled to access prescribed medication?",
    "How often have you struggled to access medical care?",
    "How often have you thought that someone was exaggerating their disability?",
    "How often have you offered unsolicited help to a disabled person?",
    "How often have you hidden aspects of yourself to seem more “employable”?"
];
$QUESTION_DEFINITIONS = "Need a word definition? (opens in a new tab) ↗";

// QUESTION 404
$TITLE_Q_404 = "Page Not Found" . $TITLE_ENDING;
$Q_404_TITLE = "This question does not exist.";
$Q_404_BUTTON_SURVEY_HOME = "Go to Survey Home";

// RESULTS
$TITLE_RESULTS = "Results" . $TITLE_ENDING;
$RESULTS_TITLE = "Results";
$NO_RESULTS_MESSAGE = "This survey currently has no results. Click the \"" . $HOMEPAGE_BUTTON_GOTO . "\" button to change that.";
$RESULTS_TBL_Q_NUMBER = "Number";
$RESULTS_TBL_QUESTION = "Question";
$RESULTS_TBL_Q_AVG_ANSWER = "Average Answer";
$RESULTS_TBL_Q_YOUR_ANSWER = "Your Answer";
$RESULTS_INTERPRETATION_INFORMATION = "We hope that the information below will contextualize your results relative to others that have taken the test. This survey is <u>not</u> meant to provide a statistical or binary measure of \"bias\" for the test-taker. However, we hope that this survey will inspire you to reflect on your own individual biases, especially as they relate to your role as an ally and to your future career. For further reading, we encourage you to explore the additional resources on the resources page found <a href=\"https://group1.raroyston.org/a11y-resources/\" target=\"_blank\" class=\"resource-link\">here (opens in a new tab) ↗</a>.";
$CHART_AVG_TITLE = "Average Answers Based on Question Number";
$CHART_YOUR_TITLE = "Your Answers Based on Question Number";
$CHART_X_AXIS = "Question Number";
$CHART_Y_AXIS = "Frequency";

// GROUP ANALYSIS
$TITLE_ANALYSIS = "Group Analysis" . $TITLE_ENDING;

// INDIVIDUAL REFLECTIONS
$TITLE_REFLECTIONS_MAIN_PAGE = "Individual Reflections" . $TITLE_ENDING;
$TITLE_REFLECTIONS_NAMES = [
    "Ariel",
    "Charles",
    "Michael",
    "Toma"
];
$TITLE_REFLECTIONS_SECOND_HALF = $TITLE_ENDING;

?>