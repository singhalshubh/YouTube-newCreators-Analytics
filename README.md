# YouTube-newCreators-Analytics
Emulating YouTube Audience Retention Time feature.
Helping new YouTubers to analyse their content by using the statistical population at different watch time.<br>
YouTube is a platform which promotes various young content developers to outsource their talent. YouTube Creator's Analytics aims to provide a tool which can record the number of users at different watch times in the video so that the youtubers can check their content engangement time for various users and to analyse whether their risky/intuitive element of YouTube worked or not?(By seeing the analytics, one can determine the graph between time points and number of users).<br>

[![CodeFactor](https://www.codefactor.io/repository/github/singhalshubh/youtube-newcreators-analytics/badge)](https://www.codefactor.io/repository/github/singhalshubh/youtube-newcreators-analytics)

# User's Analytics
Clearly, Number of Subscribers, likes and dislikes does not help a YouTuber analyse the reason/part of video which lead to the failure or success. In such a case, YouTube Creator's Analytics help them provide a platform which can give them the graph between the number of users vs seconds of video watched. This graph can help them realise the time where maximum users stopped watching the video, and further analysis, can help them realise the success of any part of video, by seeing the percentage of users which have crossed that video time(in seconds). e.g. If 80% users have watched video more than 8seconds, it means that till 8seconds, audience was attracted, but after that something went wrong.

![alt text](https://github.com/singhalshubh/YouTube-newCreators-Analytics/blob/master/analytics3.png)

This picture is obtained from databaseState.txt database of users and their views obtained by running the system.
This picture represents that many users have watched the content till 10th sec of the video i.e. after 10seconds, there is a possibility that the content didn't attract the audience.

# Algorithm
ViewTime means the max(video.time watched) for a user.   
For one user (take maximum video time user has seen(seconds).)
if(currentViewTime > previousViewTime) {
  update viewTime;
}

# Run the repo
_For Windows 10.1_: <br>
1. Download the WAMP server and follow the database MySQL as mentioned in sqldatabaseState.txt<br>
2. Download pChart2.1.4 in the same directory as the project.<br>
3. View the project at 127.0.0.1 either on Mozilla or Chrome.<br>
4. Download any video (.mp4) in the same directory as that of the project and name it video.mp4 <br>
5. If you want to embed any youtube video, use <iframe> tag instead of <source> &<video> tag in video.php (Refer MDN docs). <br>
6. The barGraph will be saved as analytics.png in the same directory. If you want to change the name of the video, go to graph.php and     graph.html and change the name.<br>

_For Ubuntu_ install the XAMPP Server and proceed the same way.<br>
  
# System Design Details

## Implementation of Login <br>
1. Login requires phone number(without country code) and password(of any type). The restriction to having phone number of 10 digits, I have used : <br>
    - Starting with 0, disables the keypress any further.<br>
    - Typing 10 digits, after that keypress is disabled.<br>
    - If user tries to input less than 10 digits, php file(login.php) checks the length of phone number, and if found < 10, returns           wrongIndex.html i.e. unacceptable credentials.<br>
    - Wrong password, for a username also generates the same wrongIndex.html<br>
    - If username is new i.e. phone number is new, it enters the database and directs to video.php<br>
2. Form is used for submitting the login credentials to the database.<br>

## Implementation of Video Player and Recording the user’s last video currentTime before closing the session (using video.php, views.php)<br>
1. Play/Pause button, Record the current time of the video is implemented.<br>
2. Play() and Pause() functions have been used with a feature of resuming from the previous watch time of the video in an intra session. Session wise can also be implemented by editing the database(making view as a set and pushing the views every time pause is pressed in a session. Finally when the session is over, update the float field of final view as the trigger of pressing the close button).  Used cookies for restoring the previous time from the database.<br>
3. The close button is responsible for recording the current time of the video and updating the database using php file(form).<br>
	
## Implementation of BarGraph
1. Take the views from the database and make the array.<br>
2. Make the data points of the array and connect it with the image, and draw the barGraph, remembering that font cannot be eliminated and the views are in seconds.<br>
3. Graph.php contains a bar-graph while adminGraph.php contains a scatter plot. <br>
4.) pChart has been used. Download pChart and use the includes mentioned in the graph.php and adminGraph.php with the proper path.<br>
    ./pChart/class/…. Or ./pChart/fonts/… is when pChart is available in the same directory, otherwise for another location represent it     as $location(of your own choice), replace it with ./($location)/pChart/…(have suitable permissions to access it).
