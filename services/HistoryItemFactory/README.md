As we need history models' data in different presentation types (output and export), let's introduce DTOs which will contain data only need in each particular case.
Creation of DTO in each of the cases are done by factories which apply a set of operations to tailor model to the case.

HistoryItem is DTO abstraction.
HistoryListItem is DTO for HistoryList (contains body; view and params to render).
HistoryExportItem is DTO for HistoryExport (contains body only).

Factories specify how to construct particular DTO for given model.
Various DTO modifier methods introduced for every possible history model subtype (event and object), allowing easy extension with new subtypes.

UML for this structure is:
https://viewer.diagrams.net/?tags=%7B%7D&highlight=0000ff&edit=_blank&layers=1&nav=1&title=HistoryItemFactory.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1VWQg9Kp5_MoezdXlWB8zhogvsxJ9Vruq%26export%3Ddownload

To introduce new events and objects:
1. Create new HistoryItemMethod containing logic for DTO custom filling.
2. Add it to corresponding (or all) ItemFactory for needed events (or all).

Example: methods/WhatsAppMethod.php