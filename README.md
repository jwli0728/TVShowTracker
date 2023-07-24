# TV Show Tracker
## A web application that allows users to find and track their progress on TV shows.

The topic of this project was finding TV shows, and the purpose was to allow users to search up available TV shows and create watch lists that can be updated with statuses. 

First, when the user opens the website, they are shown a search bar and a list of cards that have currently airing TV shows on them. When they enter a search term through the search bar, the website makes a call to the Simkl API (which has information on a large database of TV shows). These shows then get displayed as cards/rows on the screen. 

On the navigation bar, the user can click on my watch list to see the list of shows they have saved onto a database managed by a MAMP server. Each row of the table displays each shows’ title, genre, release year, and watch status. The shows are ordered by watch status (Not Started, then In Progress, then On Hold, then Finished). The user can press on the buttons on the side to delete a show from the watch list or edit the information (such as if they want to change the show’s status from “In Progress” to “On Hold”. Under the list, the user is shown a summary of their watch list grouped by watch status. 

Finally, in the last tab of the navigation bar, the user may add new shows to their watch list by manually entering the title, genre, and release year which they may have discovered by searching through the API. Whenever a user successfully creates, updates, or deletes from their watch list, they are taken to a confirmation screen that executes the SQL code and provides the user another link to the “My Watch List” page on the website. 
