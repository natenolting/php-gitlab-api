<?php namespace Gitlab\Tests\Model;

use Gitlab\Client;
use Gitlab\Model\Project;
use Http\Client\HttpClient;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    abstract protected function getModelClass();

    protected function faker()
    {
        return \Faker\Factory::create();
    }

    /**
     * @param array $methods
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getModelMock(array $methods = [])
    {
        $project = $this->getMockBuilder(Project::class)
            ->getMock();

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->setMethods(array('sendRequest'))
            ->getMock();
        $httpClient
            ->expects($this->any())
            ->method('sendRequest');

        $client = Client::createWithHttpClient($httpClient);

        return $this->getMockBuilder($this->getModelClass())
            ->setMethods($methods)
            ->setConstructorArgs(array($project, 1, $client))
            ->getMock();
    }
}
