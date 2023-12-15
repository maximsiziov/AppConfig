<?php

namespace App\Command;

use App\Entity\Asset;
use App\Entity\Definition;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDataBaseCommand extends Command
{

    protected static $defaultName = "test:fillDb";
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $name = null)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Загружает тестовые данные в базу');
    }

    private $assetsJson = '{"android":[{"version":"13.2.528","hash":"828e6360af99ad85332c23c613a772d7392b9d0fadb70529d808d71e3f9b3a2f"},
    {"version":"13.9.519","hash":"7a2d9abb574c90271470b4f2068847cc341a86712cd142b16c42cc585caec280"},
    {"version":"14.7.159","hash":"073a0aa3fd26d7aa29c2628d5397ff28684c93796d2ed544c7bdf04b23a2b2fe"},
    {"version":"14.8.40","hash":"a0612f6a34fee23f4992b7d3fd3ad5a9ce52b58bdeaaeaa731fd705e24c74f3b"},
    {"version":"14.2.723","hash":"1a9161858bd2ef319be655c6a6cbb5f2b4d70d9de54eaf4e01a43ca5922819aa"},
    {"version":"14.8.447","hash":"7b49ade9146a11ecbafa1b3c9ed25d1972e1a7c8b2b292e8b3ad1bb599024804"},
    {"version":"13.5.244","hash":"b3ae0012945e1e66cf0a0f8457ac3177ee6aed5c6f51277bbd80e8a9fe374318"},
    {"version":"14.7.919","hash":"39a9694e5dfff21474c39337ea1bdffe460b660804b0d70587b565c4046fbbb5"},
    {"version":"14.0.357","hash":"f5fbc72c0eeb9eacaec64ca0416b803ec3bb52b1f6f351e84a2f0d027740a25c"},
    {"version":"13.5.275","hash":"0b313712189f60d9f46d36577140fb58beaec610353850f050cb8975f56ae381"}],
    "ios":[{"version":"14.4.861","hash":"1c850519f489a5be7edd18dd2afa479fefe7acb0a90703176ea4360b8f79afdc"},
    {"version":"13.1.783","hash":"411b8d8d1d0a6efe1d5747a102ef5ca7f9494289bff3dc312db67ab789e790da"},
    {"version":"14.6.743","hash":"a3a0bab640523e027c9b771e322d1a42ef48e4d4e9458275ab8c98ba8b228237"},
    {"version":"12.4.328","hash":"5a9ed5b61b2e91059f032c52eec2599fb66698f20491078cde82489fec3b4737"},
    {"version":"13.2.906","hash":"4045c7015a4209e3d6087a2bfe8703062e413734bdcba64dde4a1c84e6334f82"},
    {"version":"14.0.415","hash":"a427fa66d0aca792aeb47c138ac94952e4e805b6a2d9c5b2fee7d0a4f4f6f7fe"},
    {"version":"12.0.631","hash":"d52e9c262e4bb9748f478b7024c2110586b6f5cc9e93a0a5fcd8c6d3a5cc84df"},
    {"version":"13.5.397","hash":"bca26f79b50510993e02357bdd6d58a8a23eccfa302ca14b4a74716b53880ddb"},
    {"version":"12.3.817","hash":"5d23dc0f64949df356b361659fc2c3979a3da03e27a8b2efc61e4e5da9601706"},
    {"version":"12.6.496","hash":"911a56bcea6b52b8d19eb3b4b164f4903da510245479782b28acf8f0c1b6b603"}]}';

    private $definitionsJson = '{"android":[{"version":"14.8.98","hash":"3cf8d7c4f083887f2212fc41d606c7f6951964fc57b4ccfcf87c5ea98d6e068a"},
    {"version":"12.3.567","hash":"1100820bad8865c4c31341f4f8b45caddde600f7151e0830116a6ad5ad513706"},
    {"version":"12.8.199","hash":"89a4912b97ed71a0888af65e9db40f6586d45de2965271376acd803eb0ad9679"},
    {"version":"12.0.177","hash":"46c8467f4ec6b9c23808e43f6422af45c8bdf6556496e6b78629d8a219e43cde"},
    {"version":"13.6.610","hash":"0d3606b99d782464b49dcf449c3c7e8551929abb1d7c00d9fec2ff522afd4f32"},
    {"version":"13.2.20","hash":"a1a352bef3e7320af0531e62249a8f8810298c6484930454e9275af430ec22c5"},
    {"version":"12.4.155","hash":"6b332e0e098812bf5d39959d4b2407a06a7cb1997633c40ca874764138fa6b9f"},
    {"version":"14.1.822","hash":"1924799c29bbcf603b532e1e1f7485bee001f81d64dba7b23e7c80da20aa9a3a"},
    {"version":"12.6.962","hash":"a0c595a5455376ebdc8230687f697a991d4b65ad3c530a810c73b38b90bc0cba"},
    {"version":"13.2.296","hash":"2deb607ecbfd8b6bda8c4d808e636dabdf1568f279421e85db42e54d5a95b19f"}],
    "ios":[{"version":"12.3.807","hash":"15ce021ae95ed3b1d352222176c58becd531d4cb0532e096f77cf1dd739f51b3"},
    {"version":"14.2.281","hash":"a8c0f8b15e193350214e38f312adb34447337a387f1dab5834a72a58f114431d"},
    {"version":"13.3.481","hash":"1c179f61a6c7287601acdbd4eea71e81e09c4f4da0a016d3aa0ceb62144d56ae"},
    {"version":"13.5.693","hash":"bcc4807d191493e0721eeed8e2859157579f73c9fb74285cd4257edacb7cf84a"},
    {"version":"14.5.580","hash":"b3c574cdd81fdc66617e8d86d381fc9e0dbb8e68963ed3e86963b3de92519090"},
    {"version":"12.4.454","hash":"2948648b91640c4ae6e7f84989778b5c252da9990b8b50bcad947ffea09e6a57"},
    {"version":"13.0.435","hash":"d1c76170e9a97a196258add3b51741a3e23a541b01127f9b1656f801cdd0e8f9"},
    {"version":"12.4.623","hash":"4f4b1e592479d8a01fded1f3190e0d055e6e588c38a2a50b03c017548d6d0f5a"},
    {"version":"12.8.819","hash":"175c446b7eb7f6fce2a9371c8ca23d0f1cf1924107653895d4c67d31e04465db"},
    {"version":"12.1.761","hash":"d20350e978ead423de633264da8b23afafb13c751c1811afc53591c92096892d"}]
  
}';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return Command::SUCCESS;
    }

    private function addAsset($data, $platform)
    {
        [$major, $minor, $patch] = explode('.', $data['version']);
        $asset = new Asset();
        $asset->setMajorVersion($major);
        $asset->setMinorVersion($minor);
        $asset->setPatchVersion($patch);
        $asset->setHash($data['hash']);
        $asset->setPlatform($platform);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();
    }

    private function addDefinition($data, $platform)
    {
        [$major, $minor, $patch] = explode('.', $data['version']);
        $definition = new Definition();
        $definition->setMajorVersion($major);
        $definition->setMinorVersion($minor);
        $definition->setPatchVersion($patch);
        $definition->setHash($data['hash']);
        $definition->setPlatform($platform);
        $this->entityManager->persist($definition);
        $this->entityManager->flush();
    }
}