<?php

namespace app\models;

use app\core\Model;

class Project extends Model
{
    private $id;
    private $name;
    private $desc;
    private $deadline;
    private $devPeriod;
    private $serviceId;
    private $typeId;
    private $likes;
    private $alias;
    private $textHtml;
    private $previewId;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setDesc(string $desc)
    {
        $this->desc = $desc;
    }
    public function setDeadline(string $deadline)
    {
        $this->deadline = $deadline;
    }
    public function setDevPeriod(string $devPeriod)
    {
        $this->devPeriod = $devPeriod;
    }
    public function setServiceId(int $serviceId)
    {
        $this->serviceId = $serviceId;
    }
    public function setTypeId(int $typeId)
    {
        $this->typeId = $typeId;
    }
    public function setLikes(int $likes)
    {
        $this->likes = $likes;
    }
    public function setAlias(string $alias)
    {
        $this->alias = $alias;
    }
    public function setTextHtml(string $textHtml)
    {
        $this->textHtml = $textHtml;
    }
    public function setPreviewId(int $previewId)
    {
        $this->previewId = $previewId;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getDeadline()
    {
        return $this->deadline;
    }
    public function getDevPeriod()
    {
        return $this->devPeriod;
    }
    public function getServiceId()
    {
        return $this->serviceId;
    }
    public function getTypeId()
    {
        return $this->typeId;
    }
    public function getLikes()
    {
        return $this->likes;
    }
    public function getAlias()
    {
        return $this->alias;
    }
    public function getTextHtml()
    {
        return $this->textHtml;
    }
    public function getPreviewId()
    {
        return $this->previewId;
    }

    public function getProjectByAlias(string $alias) {
        $query = "SELECT * FROM Projects WHERE alias = '$alias'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getProjectImages(int $id) {
        $query = "SELECT * FROM Images WHERE project_id = $id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getProjectTeam(int $id) {
        $query = "SELECT * FROM ProjectTeam WHERE project_id = $id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getProjectTechnologies(int $id) {
        $query = "SELECT * FROM Technologies WHERE project_id = $id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM Technologies WHERE project_id = $id";
        $this->db->connection->query($query);

        $query = "DELETE FROM ProjectTeam WHERE project_id = $id";
        $this->db->connection->query($query);

        $query = "DELETE FROM Images WHERE project_id = $id";
        $this->db->connection->query($query);

        $query = "DELETE FROM Projects WHERE id = $id";

        return $this->db->connection->query($query);
    }

    public function edit(int $id, array $data)
    {
        if ($data['images']) {
            $data['images'] = array_unique($data['images']);
            $curImagesIds = [];

            foreach ($this->getProjectImages($id) as $value) {
                $curImagesIds[] = $value['image_id'];
            }

            if (count($data['images']) >= count($curImagesIds)) {
                foreach ($data['images'] as $value) {
                    if (!in_array($value, $curImagesIds)) {
                        $query = "INSERT INTO Images (`image_id`, `project_id`) VALUES (" . $value . ", " . $id . ")";
                        $this->db->connection->query($query);
                    }
                }
            }
            else if (count($data['images']) <= count($curImagesIds)) {
                foreach ($curImagesIds as $value) {
                    if (!in_array($value, $data['images'])) {
                        $query = "DELETE FROM `Images` WHERE `image_id`=$value AND `project_id`=$id";
                        $this->db->connection->query($query);
                    }
                }
            }
        }

        $query = "UPDATE Projects SET `name`='" . $data['name'] . "', `desc`='" . $data['description'] . "', `deadline`='" . $data['deadline'] . "', `periodOfDev`='" . $data['devPeriod'] . "', `service_id`=" . $data['service'] . ", `type_id`=" . $data['type'] . ", `alias`='" . $data['alias'] . "', `textHtml`='" . $data['textHtml'] . "', `preview_id`=" . $data['preview'] . " WHERE id=$id";

        return $this->db->connection->query($query);
    }

    public function editProjectTeam(int $id, array $data)
    {
        $teamIds = [];

        foreach ($this->getProjectTeam($id) as $value) {
            $teamIds[] = $value['member_id'];
        }

        if (array_key_exists('teamMembers', $data)) {
            if (count($data['teamMembers']) >= count($teamIds)) {
                foreach ($data['teamMembers'] as $value) {
                    if (!in_array($value, $teamIds)) {
                        $query = "INSERT INTO ProjectTeam (`member_id`, `project_id`) VALUES (" . $value . ", " . $id . ")";
                        $this->db->connection->query($query);
                    }
                }
            }
            else if (count($data['teamMembers']) <= count($teamIds)) {
                foreach ($teamIds as $value) {
                    if (!in_array($value, $data['teamMembers'])) {
                        $query = "DELETE FROM `ProjectTeam` WHERE `member_id`=$value AND `project_id`=$id";
                        $this->db->connection->query($query);
                    }
                }
            }
        }
    }

    public function editProjectTechnologies(int $id, array $data)
    {
        $techds = [];

        foreach ($this->getProjectTechnologies($id) as $value) {
            $techds[] = $value['technology_id'];
        }

        if (array_key_exists('technologies', $data)) {
            if (count($data['technologies']) >= count($techds)) {
                foreach ($data['technologies'] as $value) {
                    if (!in_array($value, $techds)) {
                        $query = "INSERT INTO Technologies (`technology_id`, `project_id`) VALUES (" . $value . ", " . $id . ")";
                        $this->db->connection->query($query);
                    }
                }
            }
            else if (count($data['technologies']) <= count($techds)) {
                foreach ($techds as $value) {
                    if (!in_array($value, $data['technologies'])) {
                        $query = "DELETE FROM `Technologies` WHERE `technology_id`=$value AND `project_id`=$id";
                        $this->db->connection->query($query);
                    }
                }
            }
        }
    }

    public function editLikes(int $id, int $operation) {
        $cur_likes = $this->getById('Projects', $id)['likes'];
        
        $new_likes = $operation ? ($cur_likes + 1) : ($cur_likes - 1);

        $query = "UPDATE Projects SET `likes`=" . $new_likes . " WHERE id=$id";

        return $this->db->connection->query($query);
    }

    public function add(array $data)
    {
        $query = "INSERT INTO Projects (`name`, `desc`, `deadline`, `periodOfDev`, `service_id`, `type_id`, `likes`, `alias`, `textHtml`, `preview_id`) VALUES ('" . $data['name'] . "', '" . $data['description'] . "', '" . $data['deadline'] . "', '" . $data['devPeriod'] . "', " . $data['service'] . ", " . $data['type'] . ", 0, '" . $data['alias'] . "', '" . $data['textHtml'] . "', " . $data['preview'] . ")";

        $this->db->connection->query($query);

        $projectId = $this->db->connection->query("SELECT * FROM `Projects` WHERE `alias`='" . $data['alias'] . "'")->fetch_assoc()['id'];

        if ($data['images']) {
            $data['images'] = array_unique($data['images']);

            foreach ($data['images'] as $value) {
                $query = "INSERT INTO Images (`image_id`, `project_id`) VALUES (" . $value . ", " . $projectId . ")";
                $this->db->connection->query($query);
            }
        }

        if ($data['teamMembers']) {
            foreach ($data['teamMembers'] as $value) {
                $query = "INSERT INTO ProjectTeam (`member_id`, `project_id`) VALUES (" . $value . ", " . $projectId . ")";
                $this->db->connection->query($query);
            }
        }

        if ($data['technologies']) {
            foreach ($data['technologies'] as $value) {
                $query = "INSERT INTO Technologies (`technology_id`, `project_id`) VALUES (" . $value . ", " . $projectId . ")";
                $this->db->connection->query($query);
            }
        }
    }
}