<?php
namespace App\Event;

use App\Acl;
use App\Entity\Station;
use App\Entity\User;
use App\Http\Router;
use App\Radio\Backend\AbstractBackend;
use App\Radio\Frontend\AbstractFrontend;

class BuildStationMenu extends AbstractBuildMenu
{
    public const NAME = 'build-station-menu';

    /** @var Station */
    protected $station;

    /** @var AbstractBackend */
    protected $backend;

    /** @var AbstractFrontend */
    protected $frontend;

    /**
     * @param Acl $acl
     * @param User $user
     * @param Router $router
     * @param Station $station
     * @param AbstractBackend $backend
     * @param AbstractFrontend $frontend
     */
    public function __construct(
        Acl $acl,
        User $user,
        Router $router,
        Station $station,
        AbstractBackend $backend,
        AbstractFrontend $frontend)
    {
        parent::__construct($acl, $user, $router);

        $this->station = $station;
        $this->backend = $backend;
        $this->frontend = $frontend;
    }

    /**
     * @return Station
     */
    public function getStation(): Station
    {
        return $this->station;
    }

    /**
     * @return AbstractBackend
     */
    public function getStationBackend(): AbstractBackend
    {
        return $this->backend;
    }

    /**
     * @return AbstractFrontend
     */
    public function getStationFrontend(): AbstractFrontend
    {
        return $this->frontend;
    }

    /**
     * @inheritdoc
     */
    public function checkPermission(string $permission_name): bool
    {
        return $this->acl->userAllowed($this->user, $permission_name, $this->station->getId());
    }
}