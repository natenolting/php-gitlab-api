<?php namespace Gitlab\Tests\Model;

use Gitlab\Model\AbstractModel;
use Gitlab\Model\MergeRequest;

class MergeRequestTest extends TestCase
{

  /**
   * Test that the merge method can accept an array as the parameter
   * @test
   */
    public function mergeCanAcceptAnArray()
    {

        $mergeParams = array(
            'merge_commit_message' => $this->faker()->sentence,
            'should_remove_source_branch' => true,
            'merge_when_pipeline_succeeds' => true,
            'sha' => $this->faker()->md5
        );
        $expectedArray = array(
          'description' => $mergeParams['merge_commit_message'],
          'merge_when_pipeline_succeeds' => $mergeParams['merge_when_pipeline_succeeds'],
          'sha' => $mergeParams['sha'],
          'should_remove_source_branch' => $mergeParams['should_remove_source_branch']
        );
        $model = $this->getModelMock();
        $model->expects($this->once())
              ->method('merge')
              ->with($mergeParams)
              ->willReturn($expectedArray);

        $this->assertEquals($expectedArray, $model->merge($mergeParams));

    }

    protected function getModelClass()
    {
        return 'Gitlab\Model\MergeRequest';
    }

    protected function getMergeRequestsData()
    {
    }
}
