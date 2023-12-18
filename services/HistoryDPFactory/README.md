DataProvider abstraction for History model.
This is a bit redundant because it basically wraps HistorySearch, which can be used by itself, however if anything goes wrong, we would be potentially exposed to changing DataProvider in a lot of places in code,
so this serves as kind of History DataProvider central.