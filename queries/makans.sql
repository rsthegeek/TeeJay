select v.id from venues as v
    left join complexes as comp on v.complex_id = comp.id
    where v.id not in (
        select c.venue_id from classes as c
        left join sessions as s on (
            c.first_session_id  = s.id or
            c.second_session_id = s.id or
            c.third_session_id  = s.id
        )
        where (
            (c.first_session_day = 3 or c.third_session_day = 3 or c.second_session_day = 3) and
            (TIME(s.ends_at)    > '16:30:00') and
            (TIME(s.starts_at)  < '18:00:00')
        )
    )
