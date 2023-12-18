Provides two services - DataProvider factory and DTO factory.
Each application part gets a tuple of (DataProvider factory, DTO factory).

ps.
Could possibly introduce one more level of abstraction presenting each needed combination of DP-F and DTO-F.
Smth like:
interface HistoryService {
    getDataProviderFactory();
    getItemFactory();
}