export interface VisitStats {
  total: number
  today: number
  last7Days: number
  last30Days: number
  uniqueVisitorsTotal: number
  daily: Array<{ date: string; total: number; uniqueVisitors: number }>
}
