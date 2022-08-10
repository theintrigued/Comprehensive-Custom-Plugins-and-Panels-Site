# A Comprehensive Custom Plugins and Admin Panels Site

These are actually the important files and folders from a fully functional site that I built.

The site had the following functionalities:
1. The site was built for a 'Survey Completion' purpose, which rewarded users with a in-game currency called 'Robux' in the game Roblox.
2. An offer-wall was integrated in the site, which communiated with the AdGateReward API to reward players, in the form of postback requests to the server. Alot of custom user data was saved during the process.
3. It had a referral system, which is exactly how it sounds like. You send the link to a friend/person, and you get some piece of their rewards when they earn. Kind of a branching idea.
4. Upon user registration, the username must be registered with Roblox, so the Roblox API was also used to make sure this happens.
5. Another significant part of the site was the payouts. When the user has a specific amount, they can withdraw their earned Robux. When a user does this, an entry is made for them in the admin panel in the backend saying that a withdrawal is pending, and the admin can assign a 'Gift Card' code to their account which the player would see as soon as the admin assigns the card.
6. For the admin, a custom Admin Panel section was made which made the admin to be able to add Gift Cards and pay pending withdrawls.
7. A promocode system was also added with the same idea.
8. Moreover, rewards were also given for clicking specific links on the site.
9. Another functionality was added which allowed the users to be able to see their Roblox Avatar on the site as a way of identifying themselves.
