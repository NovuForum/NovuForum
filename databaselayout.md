# Novuforums Database layout
All tables have "nf_" prefix

| users:      | type length   | attributes/default  |
| ----------- | -----------   | ------------------- |
| id          | double        | autoincrement       |
| username    | varchar 20    | null                |
| email       | varchar 50    | null                |
| password    | varchar 100   | null                |
| firstname   | varchar 30    | null                |
| lastname    | varchar 30    | null                |
| gender      | int           | 0                   |
| birthday    | date          | null                |
| status      | varchar 140   | null                |
| location    | varchar 100   | null                |
| occupation  | varchar 100   | null                |
| website     | varchar 255   | null                |
| about       | text          | null                |
| avatar      | varchar 255   | null                |
| twitter     | varchar 15    | null                |
| postcount   | double        | 0                   |
| groups      | text          | []                  |
| permissions | text          | []                  |

| groups:     | type length   | attributes/default  |
| ----------- | ------------- | ------------------- |
| id          | double        | autoincrement       |
| name        | varchar 30    | null                |
| title       | varchar 20    | null                |
| description | text          | null                |
| color       | varchar 8     | #FFFFFF             |
| permissions | text          | []                  |

| posts:    | type length   | attributes/default  |
| --------- | ------------- | ------------------- |
| forumid   | double        | null                |
| topicid   | double        | autoincrement       |
| postid    | double        | null                |
| title     | varchar 100   | null                |
| content   | text          | null                |
| date      | datetime      | current_time        |
| edited    | boolean       | 0(false)            |
| ownerid   | double        | null                |
| locked    | boolean       | 0(false)            |
| rating    | text          | null                |

| forums:   | type length   | attributes/default  |
| --------- | ------------- | ------------------- |
| id        | double        | autoincrement       |
| type      | int           | 0                   |
| title     | varchar 100   | null                |
| content   | varchar 255   | null                |
| url       | varchar 255   | null                |

| data:        | type length   | attributes/default |
| ------------ | ------------- | ------------------ |
| id           | double        | autoincrement      |
| sitename     | varchar 255   | null               |
| sitedesc     | text          | null               |
| canregister  | boolean       | 1(true)            |
| defaultgroup | double        | 0                  |

| plugins:      | type length   | attributes/default  |
| ------------- | ------------- | ------------------- |
| id            | double        | autoincrement       |
| defaultpage   | varchar 255   | null                |
| enabledpages  | text          | null                |
|
