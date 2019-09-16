<?php
namespace Spindogs\Laravel\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequest;

    protected $data = [];

    /**
     * @param string|array $key
     * @param mixed $value
     * @return mixed
     */
    public function data($key, $value = null)
    {
        if (is_array($key)) {
            $data = $key;
            $this->data = array_merge($this->data, $data);
        } else {
            $this->data[$key] = $value;
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    protected function getData($key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @param string $template
     * @param array $data
     * @return Response
     */
    public function view($template, $data = [])
    {
        $this->data($data);
        return view($template, $this->data);
    }
}
