SELECT
  a.id,
  a.title,
  a.content,
  a.picture,
  a.date_publish,
  u.id as user_id,
  u.firstname,
  u.lastname,
  u.email,
  u.role
FROM articles as a
  JOIN users as u ON u.id = a.id_user
WHERE a.id = 10;
