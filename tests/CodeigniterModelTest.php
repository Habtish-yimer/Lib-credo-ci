<?php

namespace Rougin\Wildfire;

class CodeigniterModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \CI_Controller
     */
    protected $ci;

    /**
     * @var integer
     */
    protected $expectedRows = 10;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * Sets up the CodeIgniter application.
     *
     * @return void
     */
    public function setUp()
    {
        $appPath = __DIR__ . '/TestApp';

        $this->ci = \Rougin\SparkPlug\Instance::create($appPath);

        $this->ci->load->helper('inflector');

        $this->ci->load->model(singular($this->table), '', true);
    }

    /**
     * Tests CodeigniterModel::get method.
     *
     * @return void
     */
    public function testGetMethod()
    {
        $this->assertCount($this->expectedRows, $this->ci->post->all());
    }

    /**
     * Tests CodeigniterModel::find method.
     *
     * @return void
     */
    public function testFindMethod()
    {
        $expectedId   = 2;
        $expectedName = 'viG iJOzO';

        $post = $this->ci->post->find($expectedId);

        $this->assertEquals($expectedName, $post->get_subject());
    }

    /**
     * Tests CodeigniterModel::delete method.
     *
     * @return void
     */
    public function testDeleteMethod()
    {
        $data = [ 'subject' => 'test', 'message' => 'test' ];

        $id = $this->ci->post->insert($data);

        $this->ci->post->delete($id);

        $post = $this->ci->post->find($id);

        $this->assertTrue(empty($post));
    }

    /**
     * Tests CodeigniterModel::update method.
     *
     * @return void
     */
    public function testUpdateMethod()
    {
        $expectedId = 3;

        $data = [ 'subject' => 'test', 'message' => 'test' ];

        $this->ci->post->update($expectedId, $data);

        $post = $this->ci->post->find($expectedId);

        $this->assertEquals($data['subject'], $post->get_subject());
    }
}
