# nfqTask
 Personal nfq task for the academy

To access the published page, you'll have to go to the http://tinytaskscracker.xyz/ website.
Once there, you'll see the index page of the website, which does not require authentication.
In the index page there are 4 options for a non logged-in user:
1) Register for the meeting -> here, person can enter his first name, last name, choose the appointment date and submit details for the meeting. After submitting, the person will receive his meeting code with meeting time and queue(his place in the queue according to the date and time picked) shown on the screen as well.
2) View the meeting details -> here, person can enter his meeting code and he will receive his meeting date, time until the meeting and his place in the queue displayed on the screen.
3) Cancel the meeting -> here, person can enter his meeting code and after submitting, he will cancel his meeting.
4) Login

Once logged in, you'll see 3 different buttons in the navigation bar:
1) Meetings -> here, every worker can see all the meetings, that have been succefully registered and are waiting for the appointment. To assign the meeting for himself, the worker has to press the edit button near the desired meeting and change it's state to up_next(meeting, waiting to be started soon) or started(meeting has started)
2) Individual meetings -> here, every worker can see all the meetings, that he or she had assigned for themselves. Once the meeting has finished, the worker can change the meeting state to finished or if the person didn't show, change the meeting state to canceled.
3) Display Board -> here, every worker can see active meetings(that have the meeting state changed to started) and next meetings(that have the meeting state changed to up next). Display board is refreshing every 5 seconds itself to load new meetings or remove already existing onces, which state had recently changed.

Meeting states explained:
Once the meeting is created his initial state is registered.
Once the worker assigns the meeting for himself, he has to change the meeting state to up next.
Once the worker wants to start the meeting, he has to change the meeting state to started.
Once the worker wants to finish the meeting, he has to change the meeting state to finished.
If the person didn't show up, the worker has to change the meeting state to canceled.

Regarding new workers creation:
The registered button has been removed and you cannot create the new worker from the phpmyadmin, due to the token, that won't be generated without the initial registration form, so you should use already created ones:
1)Email address: laurynas.blockis@gmail.com password: laurynas
2)Email address: martynas.blockis@gmail.com password: martynas
3)Email address: nfq@gmail.com password: nfqnfqnfq
4)Email address: nfq@nfq.com password: nfqnfqnfq
