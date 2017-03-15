<?php
require_once 'vendor/autoload.php';

class Robofile extends \Robo\Tasks
{
    use \Codeception\Task\MergeReports;
    use \Codeception\Task\SplitTestsByGroups;

    public function parallelSplitTests()
    {
//        $this->taskSplitTestFilesByGroups(5)
//            ->projectRoot('.')
//            ->testsFrom('tests/acceptance')
//            ->groupsTo('tests/_data/paracept_')
//            ->run();
        $this->taskSplitTestsByGroups(5)
            ->projectRoot('.')
            ->testsFrom('tests/acceptance')
            ->groupsTo('tests/_data/paracept_')
            ->run();

    }

    public function parallelRun()
    {
        $parallel = $this->taskParallelExec();

        $this->taskParallelExec()
            ->process('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_1 --xml tests/_log/result_1.xml acceptance')
            ->process('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_2 --xml tests/_log/result_2.xml acceptance')
            ->process('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_3 --xml tests/_log/result_3.xml acceptance')
            ->process('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_4 --xml tests/_log/result_4.xml acceptance')
            ->process('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_5 --xml tests/_log/result_5.xml acceptance')
            ->run();
    //    for ($i = 1; $i <= 5; $i++) {$this->taskExec('php C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/codecept run -c "C:/OPEN/OpenServer/domains/robocept/" --group paracept_'.$i.' --xml tests/_log/result_'.$i.'.xml acceptance')->run();
//            $parallel->process(
//                $this->taskCodecept() // use built-in Codecept task
//                //->configFile("C:/OPEN/OpenServer/domains/robocept")
//                ->configFile('C:/OPEN/OpenServer/domains/robocept/')
//            //    ->dir('C:/OPEN/OpenServer/domains/robocept/vendor/codeception/codeception/')
//            //    ->option('-d')
//                ->suite('acceptance') // run acceptance tests
//                ->group("paracept_$i")        // for all p* groups
//                ->xml("tests/_log/result_$i.xml") // save XML results
//            );
    //    }
        return $parallel->run();
    }

    public function parallelMergeResults()
    {
       $merge = $this->taskMergeXmlReports();
        for ($i=1; $i<=5; $i++) {
            $merge->from("tests/_output/tests/_log/result_$i.xml");
        }
        $merge->into("tests/_output/result_paracept.xml")->run();
    }
    
    function parallelAll()
    {
        $this->parallelSplitTests();
        $result = $this->parallelRun();
        $this->parallelMergeResults();
        return $result;
    }
}