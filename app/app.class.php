<?php

class App
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * App constructor.
     * @param $config array
     */
    public function __construct($config)
    {
        $this->db = new PDO(
            sprintf('mysql:dbname=%s;host=%s', $config['DB']['database'], $config['DB']['server']),
            $config['DB']['username'],
            $config['DB']['password']
        );
    }

    static function isSignedIn()
    {
        return isset($_SESSION['signedIn']);
    }

    static function signIn()
    {
        $_SESSION['signedIn'] = true;
    }

    static function signOut()
    {
        unset($_SESSION['signedIn']);
    }

    function addNewBeer($name)
    {
        $sth = $this->db->prepare('INSERT INTO beer(name, is_active) VALUES(:name, 1)');

        return $sth->execute(['name' => $name]);
    }

    function updateBeer($id, $name)
    {
        $sth = $this->db->prepare('UPDATE beer SET name = :name WHERE id = :id');

        return $sth->execute([
            'name' => $name,
            'id'   => $id,
        ]);
    }

    function deleteBeer($id)
    {
        $sth = $this->db->prepare('UPDATE beer SET is_active = 0 WHERE id = :id');

        return $sth->execute([
            'id' => $id,
        ]);
    }

    function getListOfBeers()
    {
        return $this->db->query('SELECT * FROM beer WHERE is_active = 1 ORDER BY id', PDO::FETCH_ASSOC)->fetchAll();
    }

    function getVotes($beer_id)
    {
        $result = [
            'pro'    => 0,
            'contra' => 0,
        ];
        $votes = $this->db->query(
            sprintf('SELECT * FROM votes WHERE beer_id = %d', $beer_id),
            PDO::FETCH_ASSOC
        )->fetchAll();
        foreach ($votes as $vote) {
            if ($vote['vote']) {
                $result['pro']++;
            } else {
                $result['contra']++;
            }
        }

        return $result;
    }

    function getAdminBeers()
    {
        $result = $this->getListOfBeers();
        foreach ($result as $key => $value) {
            $result[$key]['votes'] = $this->getVotes($value['id']);
        }

        return $result;
    }

    function getBeer($id)
    {
        $query = $this->db->prepare("SELECT * FROM beer WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function vote($id, $vote)
    {
        $sth = $this->db->prepare('INSERT INTO votes(beer_id, vote) VALUES(:id, :vote)');

        return $sth->execute([
            'id'   => $id,
            'vote' => $vote,
        ]);
    }
}