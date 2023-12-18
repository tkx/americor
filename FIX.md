Refactoring notes.

Problems.
1. Monolithic structure of front and back. Probably divide the app into two independent apps - reactjs frontend and php backend as api only.
2. The app's code is not following MVC pattern on a top-level and particular app modules are not following SOLID and design patterns. Refactor the code such that functions are in the place where it should be, removed from parts where they shouldn't be. Create services to incapsulate logic, cleaning the app from logic spreading all over.
3. App is not unitly testable as no SOLID is applied. Doing the p1 will also solve this. Same with code reusability within the app.
4. Exporting huge amounts of data. Needs additional features for exporting GBs of data.

Solution steps.
1. Clean up top-level controllers, models, widgets and views. Bring to MVC with no codes mixed.
2. Make use of widgets and widget views to make app more modular and resusable.
3. Create logic services that will read, prepare, process and return data from sources and input.
4. Create strict vertical of dependency injection for all cases.