# shoutboxMirrorBot
Telegram Bot that allows to read(write) in Telegram Client messages from(to) your website's shoutbox.

### Overview
Answer your customers on your website using Telegram!

Just imagine, you have a shoutbox on your website, no registration required, so everyone can post a message with anyone's name. However, your visitors use this chat as a feedback, and want to see your reply. So, you need some admin stuff for these purposes! But.. Nobody like signing in. 

### How it works?
You have a webchat on your website. You have a Telegram bot in your own Telegram coversation.

Anybody posts a message to webchat: bot sends it also to your Telegram conversation.
Want to answer? Write ``/send your message`` in the same conversation. Bot will add it to webchat.

### Is it secure?
You can setup telegram conversation's ID in webchat script, so no strangers will access your messages through telegram :)

### Sources
There are 2 parts: ``telegrambot`` and ``webchat``. Both are written in php. Each part can be located on a separate hosts, connected to the internet. 





