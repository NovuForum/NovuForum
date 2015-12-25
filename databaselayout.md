# Novuforums Database layout
All tables have "nf_" prefix

| users:      | type length   | attributes/default  |
| ----------- | -----------   | ------------------- |
| id          | double        | autoincrement       |
| username    | varchar 20    | null                |
| email       | varchar 100   | null                |
| password    | varchar 200   | null                |
| firstname   | varchar 100   | null                |
| lastname    | varchar 100   | null                |
| gender      | int           | 0                   |
| birthday    | date          | null                |
| status      | varchar 140   | null                |
| location    | varchar 255   | null                |
| occupation  | varchar 255   | null                |
| website     | varchar 255   | null                |
| about       | text          | null                |
| avatarurl   | varchar 255   | null                |
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

| :  | type length | attributes/default  |
| ------------- | ----------- | ------------------- |
| id            | double      | autoincrement       |
|

| posts:    | type length   | attributes/default  |
| --------- | ------------- | ------------------- |
| forumid   | double        | null                |
| topicid   | double        | null                |
| postid    | double        | null                |
| title     | varchar 255   | null                |
| content   | text          | null                |
| date      | datetime      | current_time        |
| edited    | boolean       | 0(false)            |
| ownerid   | double        | null                |
| locked    | boolean       | null                |
| rating    | text          | null                |

| forums:   | type length   | attributes/default  |
| --------- | ------------- | ------------------- |
| id        | double        | autoincrement       |
| type      | int           | 0                   |
| title     | varchar 200   | null                |
| content   | varchar 255   | null                |

| data:        | type length   | attributes/default |
| ------------ | ------------- | ------------------ |
| id           | double        | autoincrement      |
| sitename     | varchar 255   | null               |
| canregister  | boolean       | 1(true)            |
| defaultgroup | double        | 0                  |
