ITRACKB4 LA7: Let Them Add Something
Name: Manuel T. Lagmay Jr. Block: 4A

This project adds a form for adding a Bicolano dish. Dishes are now stored in storage/app/dishes.json. The form at /dishes/create posts to dishes.store, which validates the input, saves it, and redirects to the list with a one-time success message.

Part F: Explain Your Reasoning
Q1. Your form sends data with POST rather than GET. What would go wrong if it used GET instead?
If the form used GET, the dish name, ingredient and origin would be put in the URL as a query string, and that URL would sit in my browser history and be easy to bookmark or share. Worse, a browser treats a GET page as safe to repeat, so refreshing it, or pressing back and forward, would silently send the same request again and store() would save another copy of the dish. With POST, the browser knows the request changes something, so it warns me before resending it. Saving data is a change, so it belongs in POST and not in a URL that can be reloaded or opened by a link.

Q2. When validation fails, what actually stops the save, and where does the visitor end up?
$request->validate() throws a ValidationException when any rule fails, and an exception ends the method right there. That is why the lines that call getDishes(), add the new dish and call saveDishes() never run, and nothing is written to dishes.json, without me writing an if. Laravel catches the exception and redirects the visitor back to the form page (/dishes/create). It also flashes the error messages and the old input to the session, which is how @error shows the message beside each field and old() and @selected refill what they typed or chose.

Q3. Your success message is displayed from the layout, which renders on every page. Why does it not appear on every page?
The layout does run its @if (session('success')) check on every page, but the check is only true when a value is in the session. ->with('success', ...) stores that value as flash data, which Laravel keeps for the very next request only and then removes. The redirect to the list page is that next request, so the message shows there once. When I click to any other page, the flash data is already gone, so the check is false and nothing is displayed. So both are true: the layout always checks, but the message exists for only one request.