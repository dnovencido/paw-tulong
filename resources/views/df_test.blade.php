<!DOCTYPE html>
<html>
<head>
    <title>Dialogflow Test</title>
</head>
<body>
    <h1>Dialogflow Test</h1>
    <form method="POST" action="/df-test">
        @csrf
        <input type="text" name="message" placeholder="Type something" />
        <button type="submit">Send</button>
    </form>
</body>
</html>
