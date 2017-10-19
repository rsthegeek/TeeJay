select v.id from classes as c
    left join venues as v on c.venue_id = v.id
    left join complexes as comp on comp.id = v.complex_id
    left join courses on courses.id = c.course_id
    left join sessions as s on s.id = c.first_session_id
    where (
        (c.first_session_day = 3 or c.second_session_day = 3 or c.third_session_day) and
        (
            c.first_session_id in (
                select s.id from sessions as s
                    where TIME('16:35:00') Between Time(s.starts_at) and TIME(s.ends_at)
            ) or
            c.second_session_id in (
                select s.id from sessions as s
                    where TIME('16:35:00') Between Time(s.starts_at) and TIME(s.ends_at)
            ) or
            c.third_session_id in (
                select s.id from sessions as s
                    where TIME('16:35:00') Between Time(s.starts_at) and TIME(s.ends_at)
            )
        )
    )
    group by v.code, v.id
